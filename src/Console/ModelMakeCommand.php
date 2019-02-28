<?php
namespace IAtelier\Atelier\Console;

use Illuminate\Foundation\Console\ModelMakeCommand as BaseCommand;

class ModelMakeCommand extends BaseCommand
{
	protected $name = 'book-make:model';
	
	protected $description = 'Create a new Eloquent model class for the your Book Type';
	
	protected function getStub()
    {
        return __DIR__.'/stubs/model.stub';
    }
}