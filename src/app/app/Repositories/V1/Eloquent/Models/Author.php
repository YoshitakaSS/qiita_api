<?php

namespace App\Repositories\V1\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public $timestamps = true;

    // const CREATED_AT = 'create_dt';
    // const UPDATED_AT = 'update_dt';

    // protected $connection = 'mysql';
    protected $table = 'authors';
}
