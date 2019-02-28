<?php

namespace IAtelier\Atelier\Console;

use Illuminate\Database\Migrations\MigrationCreator as Base;

class MigrationCreator extends Base
{
	public function stubPath()
    {
        return __DIR__.'/stubs';
    }
}