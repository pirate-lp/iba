<?php

namespace LILPLP\IBA;

use Illuminate\Support\Facades\View as View;
use Illuminate\Support\Facades\Response as Response;

use GuzzleHttp;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\ServiceProvider as Provider;
use Illuminate\Support\Facades\Route;

use LILPLP\IBA\Console\ModelMakeCommand as ModelMakeCommand;
use LILPLP\IBA\Console\MigrateMakeCommand as MigrateMakeCommand;
use LILPLP\IBA\Console\ControllerMakeCommand as ControllerMakeCommand;
use LILPLP\IBA\Console\BookMakeCommand;

use Illuminate\Routing\Router;

class IBAServiceProvider extends Provider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->app->make('Illuminate\Contracts\Http\Kernel')->pushMiddleware('Illuminate\Session\Middleware\StartSession');
		
		$this->publishes([
        	__DIR__.'/config/iba.php' => config_path('iba.php'),
		]);
    
		require __DIR__.'/routes/web.php';
		
		$this->loadViewsFrom(__DIR__.'/resources/views', 'iba');
		
		$this->publishes([
				__DIR__.'/public' => public_path('lil-plp/iba'),
			], 'public');
		
		$this->loadMigrationsFrom(__DIR__.'/database/migrations');
		
		if ($this->app->runningInConsole()) {
	        $this->commands([
		        MigrateMakeCommand::class,
	            ModelMakeCommand::class,
	            ControllerMakeCommand::class,
	            BookMakeCommand::class,
	        ]);
	    }
		
		
		
		Response::macro('backend', function ($book)
		{
			if ( in_array('web', Route::current()->computedMiddleware) )
			{
				return back()->withInput();
			}
			else
			{
				return response()->json($book);
			}
		});
			
		
		
		
		
		
		
		View::composer('iba::modules.create', function($view) {
	        $view->with('keywords', Keyword::select('id', 'word')->get());
        });
        View::composer('iba::modules.create', function($view) {
	        $view->with('peoples', People::select('id', 'name')->get());
        });
        
        View::composer('iba::create', function($view) {
	        $view->with('keywords', Keyword::select('id', 'word')->get());
        });
        View::composer('iba::create', function($view) {
	        $view->with('peoples', People::select('id', 'name')->get());
        });
        
        View::composer('iba::modules.edit', function($view) {
	        $view->with('keywords', Keyword::select('id', 'word')->get());
        });
        View::composer('iba::amalog.modules.edit', function($view) {
	        $view->with('peoples', People::with('detail')->select('id', 'name')->get());
// 	        $view->with('peoples', People::select('id', 'name')->get()->pluck('id', 'name'));
        });
        View::composer('iba::edit', function($view) {
	        $view->with('keywords', Keyword::select('id', 'word')->get());
        });
         View::composer('iba::edit', function($view) {
	        $view->with('peoples', People::with('detail')->select('id', 'name')->get());
// 	        $view->with('peoples', People::select('id', 'name')->get()->pluck('id', 'name'));
        });
		
		
		
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		if (!Router::hasMacro('iba')) {
            $this->registerRouteMacro();
        }
        
        if (!Response::hasMacro('asset'))
        {
	        $this->registerResponseMacro();
        }
		$this->app->singleton('Illuminate\Contracts\Debug\ExceptionHandler','LILPLP\IBA\Exceptions\Handler');
	}
	
	public function registerRouteMacro()
	{
		Router::macro('iba', function($slug, $controller)
		{
			Router::get('/' . $slug .'/', $controller . '@manage');
			Router::get('/' . $slug .'/create/', $controller . '@create');
			Router::get('/' . $slug .'/{' . $slug . '}/edit', $controller . '@edit');
			Router::put('/' . $slug .'/{' . $slug . '}/', $controller . '@update');
			Router::post('/' . $slug .'/', $controller . '@store');
			
			
			Router::get('/' . $slug .'/dashboard/', $controller . '@dashboard');
		});
	}
	
	public function registerResponseMacro()
	{
		Response::macro('asset', function ($asset_name, $uri, $disk = "ibook")
		{
			if ( substr($asset_name, -3) == 'mp4' )
			{
				$file = '/var/www/lostideaslab/storage/' . $disk . '/' . $uri;
				$mime = 'video/mp4';
				$size = filesize($file);
				$length = $size;
				$start = 0;
				$end = $size - 1;
		
				header(sprintf('Content-type: %s', $mime));
				header('Accept-Ranges: bytes');
				
				if(isset($_SERVER['HTTP_RANGE']))
				{
					$c_start = $start;
					$c_end = $end;
		
					list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
		
					if(strpos($range, ',') !== false)
					{
						header('HTTP/1.1 416 Requested Range Not Satisfiable');
						header(sprintf('Content-Range: bytes %d-%d/%d', $start, $end, $size));
		
						exit;
					}
		
					if($range == '-')
					{
							$c_start = $size - substr($range, 1);
					}
					else
					{
							$range	= explode('-', $range);
							$c_start = $range[0];
							$c_end	 = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $size;
					}
		
					$c_end = ($c_end > $end) ? $end : $c_end;
		
					if($c_start > $c_end || $c_start > $size - 1 || $c_end >= $size)
					{
							header('HTTP/1.1 416 Requested Range Not Satisfiable');
							header(sprintf('Content-Range: bytes %d-%d/%d', $start, $end, $size));
		
							exit;
					}
		
					header('HTTP/1.1 206 Partial Content');
		
					$start = $c_start;
					$end = $c_end;
					$length = $end - $start + 1;
				}
		
				header("Content-Range: bytes $start-$end/$size");
				header(sprintf('Content-Length: %d', $length));
		
				$fh = fopen($file, 'rb');
				$buffer = 1024 * 8;
		
				fseek($fh, $start);
		
				while(true)
				{
					if(ftell($fh) >= $end) break;
		
					set_time_limit(0);
		
					echo fread($fh, $buffer);
		
					flush();
				}


			}
			else if (substr($asset_name, -4) == 'html')
			{
				$uri = rtrim($uri, '.html') . '/';
				return redirect($uri);
			}
			else if (substr($asset_name, -2) == 'md')
			{
				$uri = rtrim($uri, '.md') . '/';
				return redirect($uri);
			}
			else
			{
				$content = Storage::disk($disk)->get($uri);
// 				dd($uri);
				return response($content, 200)->withHeaders([
					'Content-Type' => 'image',
					'X-Header-One' => 'Header Value',
					'X-Header-Two' => 'Header Value',
				]);
			}
		});
	}
}
