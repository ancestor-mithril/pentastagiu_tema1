<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
