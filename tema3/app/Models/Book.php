<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use App\Models\Publisher;

class Book extends Model
{
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function loans()
    {
        return $this->hasMany('App\Models\Loan');
    }

    public function delete()
    {
        $this->loans()->delete();
        return parent::delete();
    }
}
