<?php

namespace App\Models\Books;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;


    public function language () {

        return $this->belongsTo(Language::class);
    }


    public function bookNotes () {

        return $this->hasMany(BookNote::class);
    }
    

    public function bookEnds () {

        return $this->hasMany(BookEnd::class);
    }


    public function readings () {

        return $this->hasMany(Reading::class);
    }


    public function type () {

        return $this->belongsTo(BookCategory::class);
    }


    public function authors () {
        
        return $this->belongsToMany(Author::class);
    }


    public function format () {

        return $this->belongsTo(BookFormat::class);
    }
}
