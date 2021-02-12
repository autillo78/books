<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_notes', function (Blueprint $table) {
            
            // COLUMNS
            $table->smallIncrements('id');
            $table->unsignedSmallInteger('book_id');
            $table->text('text');
            $table->unsignedTinyInteger('language_id');
            $table->string('pages', 12)->nullable();
            //$table->timestamps();
            $table->dateTimeTz('created_at', $precision = 0);
                        
            // INDEX
	    
            // UNIQUE
            
            // PRIMARY KEYS
            
            // FOREIGN KEYS
            $table->foreign('language_id')->references('id')->on('languages');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_notes');
    }
}
