<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peopleables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role')->nullable();
            $table->integer('people_id')->unsigned();
            $table->foreign('people_id')->references('id')->on('peoples');
	        $table->morphs('peopleable');
            $table->timestamps();
            
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peopleables');
    }
}
