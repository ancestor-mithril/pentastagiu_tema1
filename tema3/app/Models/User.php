<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
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
