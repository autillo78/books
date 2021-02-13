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
            $table->string('code', 3);
            $table->string('name', 30);
            
            // INDEX
	    
            // UNIQUE
            
            // PRIMARY KEYS
            $table->primary('code');
            
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
