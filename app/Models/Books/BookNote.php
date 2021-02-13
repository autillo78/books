<?php

namespace App\Models\Books;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookNote extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['pages', 'book_id', 'text', 'language_code', 'created_at'];
    protected $dates = ['created_at']; //to be able to format the dates ->format('y')


    public function language () {

        return $this->belongsTo(Language::class);
    }

    
    public function book () {

        return $this->belongsTo(Book::class);
    }
}
