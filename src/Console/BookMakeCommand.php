<?php

namespace LILPLP\IBA\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class BookMakeCommand extends Command
{
	protected $signature = 'book:make {type}';
	
	protected $description = 'Creating a Book type ...';
	
	public function handle()
    {
        $this->validateType();
		$type = $this->argument('type');
		$this->call('book-make:migration', ['name'=>'create_'. lcfirst(class_basename($type)) . '_table']);
		$this->call('book-make:model', ['name' => $type]);
		$this->call('book-make:controller', ['name' => $type . 'Controller', '--model' => $type]);
	}
	
	private function validateType()
	{
		$type = $this->argument('type');
		if (preg_match('([^A-Za-z0-9_/\\\\])', $type)) {
            throw new InvalidArgumentException('Model name contains invalid characters.');
        }
        
        if (in_array($type, config('iba')))
        {
	        throw new InvalidArgumentException('A Book of this type already exist in IBA.');
        }
	}
}