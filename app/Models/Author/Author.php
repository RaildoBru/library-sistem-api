<?php

namespace App\Models\Author;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Database\Factories\AuthorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Book\Book;
use App\Models\Book\Book_author;
use Illuminate\Notifications\Notifiable;

class Author extends Model
{
    /** @use HasFactory<\Database\Factories\AuthorFactory> */
    use HasFactory, Notifiable;

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

    /**
     * Create a new factory instance for the model.
     */
    /*protected static function AuthorFactory()
    {
        return AuthorFactory::new();
    }**/

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
