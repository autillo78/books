<?php

namespace App\Models\Books;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    use HasFactory;
    
    
    public $timestamps = false;


    public function book () {

        return $this->belongsTo(Book::class);
    }
}
