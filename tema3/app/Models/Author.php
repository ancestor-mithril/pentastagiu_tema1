<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }

    public function delete()
    {
        foreach ($this->books as $book)
            $book->delete();
        return parent::delete();
    }
}
