<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
           
            // COLUMNS
            $table->smallIncrements('id');
            $table->string('name', 40);
            $table->string('surname', 80);
            
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
        Schema::dropIfExists('authors');
    }
}
