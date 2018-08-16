<?php

Namespace PirateLP\IBA\Console;

use Illuminate\Database\Console\Migrations\MigrateMakeCommand as Base;

use Illuminate\Support\Composer;
use PirateLP\IBA\Console\MigrationCreator;

class MigrateMakeCommand extends Base
{
	
	 protected $signature = 'book-make:migration {name : The name of the migration.}
        {--create= : The table to be created.}
        {--table= : The table to migrate.}
        {--path= : The location where the migration file should be created.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new migration file';
    
     protected $creator;

    /**
     * The Composer instance.
     *
     * @var \Illuminate\Support\Composer
     */
    protected $composer;


	public function __construct(MigrationCreator $creator, Composer $composer)
    {
        parent::__construct($creator, $composer);
    }

}