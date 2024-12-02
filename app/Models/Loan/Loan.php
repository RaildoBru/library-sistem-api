<?php

namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Book\Book;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Loan extends Model
{
    use HasFactory, Notifiable;

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'loan_date',
        'loan_date_final',
        'book_id',
        'cliente_id'
    ];

    protected $hidden = [
        'created_at',
		'updated_at',
        'deleted_at',
    ];

    /**
     * The roles that belong to the Loan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function loans(): BelongsToMany
    {
        return $this->belongsToMany(Loan::class, 'loan', 'book_id', 'cliente_id');
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'id','book_id');
    }
}
