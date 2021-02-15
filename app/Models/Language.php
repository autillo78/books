<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $primaryKey = 'code';
    protected $keyType = 'string'; //primary key is a string not integer
    

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function bookNotes()
    {
        return $this->hasMany(BookNote::class);
    }
}
