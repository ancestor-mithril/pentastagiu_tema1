<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    /**
     * @var mixed
     */
    private $name;
    /**
     * @var mixed
     */
    private $id;
    /**
     * @var mixed
     */
    private $title;
    /**
     * @var mixed
     */
    private $author_id;
    /**
     * @var mixed
     */
    private $publisher_id;
    /**
     * @var mixed
     */
    private $publisher_year;
}
