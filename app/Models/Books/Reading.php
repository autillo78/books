<?php

namespace App\Models\Books;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    use HasFactory;
    
    
    public $timestamps = false;

    protected $fillable = ['date', 'last_page', 'book_id'];
    
    protected $dates = ['date'];


    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
