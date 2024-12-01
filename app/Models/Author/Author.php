<?php

namespace App\Models\Author;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Book\Book;
use App\Models\Book\Book_author;

class Author extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'birthday_date'
    ];

    protected $hidden = [
        'created_at',
		'updated_at',
        'deleted_at',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
