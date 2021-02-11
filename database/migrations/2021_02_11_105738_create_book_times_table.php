<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_times', function (Blueprint $table) {
            
            // COLUMNS
            $table->smallIncrements('id');
            $table->unsignedSmallInteger('book_id');
            $table->date('end_date');

            // INDEX
	    
            // UNIQUE
            
            // PRIMARY KEYS
        
            // FOREIGN KEYS
            $table->foreign('book_id')->references('id')->on('books');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_times');
    }
}
