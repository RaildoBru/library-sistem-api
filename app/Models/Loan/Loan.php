<?php

namespace App\Models\loan;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    /**
     * The roles that belong to the Loan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function loans(): BelongsToMany
    {
        return $this->belongsToMany(Loan::class, 'loan', 'book_id', 'cliente_id');
    }
}
