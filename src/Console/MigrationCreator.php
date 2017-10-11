<?php

namespace LILPLP\IBA\Console;

use Illuminate\Database\Migrations\MigrationCreator as Base;

class MigrationCreator extends Base
{
	public function stubPath()
    {
        return __DIR__.'/stubs';
    }
}