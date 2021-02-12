<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookFormatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_formats', function (Blueprint $table) {
            
            // COLUMNS
            $table->tinyIncrements('id');
            $table->string('type');

            // INDEX
	    
            // UNIQUE
            
            // PRIMARY KEYS
        
            // FOREIGN KEYS
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_formats');
    }
}
