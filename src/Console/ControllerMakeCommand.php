<?php

namespace PirateLP\IBA\Console;

use Illuminate\Routing\Console\ControllerMakeCommand as Base;

class ControllerMakeCommand extends Base
{
	
	 protected $name = 'book-make:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller class';


	protected function getStub()
    {
        return __DIR__.'/stubs/controller.stub';
    }

}