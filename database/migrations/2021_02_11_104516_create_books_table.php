<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            
            // COLUMNS
            $table->smallIncrements('id');
            $table->string('title');
            $table->unsignedSmallInteger('pages');
            $table->string('language_code', 3);
            $table->unsignedSmallInteger('type_id');
            $table->unsignedTinyInteger('format_id');
            $table->timestamps();
            //$table->dateTimeTz('created_at', $precision = 0);

            // INDEX
	    
            // UNIQUE
            
            // PRIMARY KEYS
            
            // FOREIGN KEYS
            $table->foreign('language_code')->references('code')->on('languages');
            $table->foreign('type_id')->references('id')->on('book_categories');
            $table->foreign('format_id')->references('id')->on('book_formats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
