<?php

namespace IAtelier\Atelier\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Str;

class BookMakeCommand extends Command
{
	protected $signature = 'book:make {type}';
	
	protected $description = 'Creating a Book type ...';
	
	public function handle()
    {
        $this->validateType();
		
		$table = Str::plural(Str::snake(class_basename($this->argument('type'))));

        $this->call('book-make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
        ]);
        
		$this->call('book-make:model', [
			'name' => $this->argument('type')
		]);
		
		$this->call('book-make:controller', [
			'name' => $this->argument('type') . 'Controller',
			'--model' => $this->argument('type')
		]);
	}
	
	private function validateType()
	{
		$type = $this->argument('type');
		if (preg_match('([^A-Za-z0-9_/\\\\])', $type)) {
            throw new InvalidArgumentException('Model name contains invalid characters.');
        }
        
        if (in_array($type, config('iatelier')))
        {
	        throw new InvalidArgumentException('A Book of this type already exist in iAtelier.');
        }
	}
}