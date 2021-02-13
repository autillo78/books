<?php

namespace App\Models\Books;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookNote extends Model
{
    use HasFactory;


    public function language () {

        return $this->belongsTo(Language::class);
    }

    
    public function book () {

        return $this->belongsTo(Book::class);
    }
}
