<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            
            // COLUMNS
            $table->tinyIncrements('id');
            $table->enum('code', ['es', 'en']);
           
            
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
        Schema::dropIfExists('languages');
    }
}
