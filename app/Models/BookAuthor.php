<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookAuthor extends Model
{
    use HasFactory;

    public $timestamps = false;


    public function author () {

        return $this->belongsTo(Author::class);
    }


    public function book () {

        return $this->belongsTo(Book::class);
    }
}
