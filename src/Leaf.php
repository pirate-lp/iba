<?php
namespace LILPLP\IBA;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use ParsedownExtra;

use Symfony\Component\Yaml\Yaml;

class Leaf {
	public $type;
    public $uri;
    protected $slug;
    public $base;
    
    
    function __construct($uri)
    {
	    $this->uri = $this->exists($uri);
// 	    dd($this->uri);
	    if ( $this->uri )
	    {
		    $uri_parts = explode('/', $uri);
			$uri_base = $uri_parts[0] . '/index.md';
			$this->base = $this->retriveMetas($uri_base, 'leaves');
			$this->base['slug'] = $uri_parts[0];
			$this->menu = $this->constructMenu($uri_parts[0]);
	    }
	    return $this->uri;
    }
    
    public function exists($uri)
	{
		$file = rtrim($uri,'/') . ".md";
		$directory = $uri . "/index.md";
		$asset = $uri;
		if ( Storage::disk('leaves')->exists($file) ) {
			$this->type = "file";
			return $file;
		}
		if ( Storage::disk('leaves')->exists($directory) ) {
			$this->type = "directory";
			return $directory;
		}
		if ( Storage::disk('leaves')->exists($asset) ) {
			$this->type = "asset";
			return $asset;
		}
		return false;
	}
	
	
	public function cssStandards($content)
	{
		$cssStandards = array ( "mainStandard" => "cen pure-u-1 pure-u-sm-23-24 pure-u-md-17-24 pure-u-lg-15-24 pure-u-xl-13-24",
			"ideaStandard" => 'cen pure-u-1 pure-u-sm-24-24 pure-u-md-23-24 pure-u-lg-21-24 pure-u-xl-19-24',
			'ideaIStandard' =>	'cen pure-u-23-24 pure-u-sm-22-24 pure-u-md-21-24 pure-u-lg-19-24 pure-u-xl-17-24',
			"textStandard" => "cen pure-u-1 pure-u-sm-23-24 pure-u-md-23-24 pure-u-lg-19-24 pure-u-xl-20-24",
			"textIndex" => "cent pure-u-1 pure-u-sm-1-1 pure-u-md-1-3 pure-u-lg-7-24",
			"textContent" => "cent pure-u-1 pure-u-sm-1-1 pure-u-md-2-3 pure-u-lg-17-24",
			"ideaLStandard" => "pure-u-1 pure-u-sm-1-1 pure-u-md-2-3 pure-u-lg-3-5 pure-u-xl-3-5",
			"ideaSStandard" => "pure-u-1 pure-u-sm-1-1 pure-u-md-1-3 pure-u-lg-2-5 pure-u-xl-2-5",
			"HTitleStandard" => "pure-u-1 pure-u-sm-1-1 pure-u-md-1-3 pure-u-lg-5-12",
			"HMotoStandard" => "pure-u-1 pure-u-sm-1-1 pure-u-md-2-3 pure-u-lg-7-12");
        
        $keys = $values = array();
        foreach ($cssStandards as $key => $value) {
		    $keys[] = '%' . $key . '%';
		    $values[] = $value;
        }
        return str_replace($keys, $values, $content);
	}
    
    
    public function render($file, $disk = 'seed')
	{
	    $leaf = $this->retriveMetas($file, $disk);
	    $rawContent = Storage::disk($disk)->get($file);
	    $leaf['slug'] = $this->slug;
	    
	    $metaHeaderPattern = "/^(\/(\*)|---)[[:blank:]]*(?:\r)?\n"
	    . "(?:(.*?)(?:\r)?\n)?(?(2)\*\/|---)[[:blank:]]*(?:(?:\r)?\n|$)/s";
	    $content = preg_replace($metaHeaderPattern, '', $rawContent, 1);
	    $content_css = $this->cssStandards($content);
		$extra = new ParsedownExtra();
		$leaf['content'] = $extra->text($content_css);
	    return $leaf;
	}
	
	public function retriveMetas($file, $disk)
	{
		$rawContent = Storage::disk($disk)->get($file);
	    $pattern = "/^(\/(\*)|---)[[:blank:]]*(?:\r)?\n"
	 . "(?:(.*?)(?:\r)?\n)?(?(2)\*\/|---)[[:blank:]]*(?:(?:\r)?\n|$)/s";
	    if (preg_match($pattern, $rawContent, $rawMetaMatches) && isset($rawMetaMatches[3]))
	    {
	        $metas = Yaml::parse($rawMetaMatches[3]);
	        $metas = ($metas !== null) ? array_change_key_case($metas, CASE_LOWER) : array();
	    }
	    return $metas;
	}
	
	public function content() {
		
		$leaf = $this->render($this->uri, 'leaves');
		$base = $this->base;
		return 	response()->json($leaf);
	}
	
	
	public function show()
	{
		switch ($this->type) {
			case "directory":
			case "file":
				return $this->display();
				break;
			case "asset":
				$asset = Storage::disk('leaves')->get($this->uri);
				$asset_name = last(explode('/', $this->uri));
				return response()->asset($asset_name, $this->uri, 'leaves');
				break;
		}
	}
	
	public function display() {
		$leaf = $this->render($this->uri, 'leaves');
		$base = $this->base;
		$menu = $this->menu;
		if ( array_key_exists('style', $leaf) )
		{
			$blade_file = 'leaf.' . $leaf['style'];
			
			if ( $leaf['style'] != 'index' ) {
				return response()->view($blade_file, compact('leaf', 'base', 'menu'), '200');
			}
			return response()->view('leaf', compact('leaf', 'base', 'menu'), '200'); /// to be changed later !!!
		}
		return 	response()->view('leaf', compact('leaf', 'base', 'menu'), '200');
	}
	
	
	public function constructMenu($base) {
		$directories = [];
		foreach ( Storage::disk('leaves')->directories($base) as $sub )
		{
			$directories[$sub] = Storage::disk('leaves')->directories($sub);
		}
		return $directories;
	}
}