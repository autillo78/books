<?php

namespace App\Models\Books;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    public $timestamps = false;


    public function books () {

        return $this->hasMany(Book::class);
    }

    public function bookNotes () {

        return $this->hasMany(BookNote::class);
    }
}
