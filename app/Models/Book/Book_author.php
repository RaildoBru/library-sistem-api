<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Model;

class Book_author extends Model
{
    public function initialize(array $config)
    {
        $this->belongsToMany('book_author');
    }
}
