<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Model;
use App\Models\Author\Author;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Book\Book_author;
use Database\Factories\BookFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Book extends Model
{
    use HasFactory, Notifiable;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'publication_date'
    ];

    protected $hidden = [
        'created_at',
		'updated_at',
        'deleted_at',
    ];

    public function authors()
    {
        return $this->belongsToMany(Author::class,'book_author');
    }
}
