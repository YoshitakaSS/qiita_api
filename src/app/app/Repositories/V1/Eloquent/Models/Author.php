<?php

namespace App\Repositories\V1\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    const CREATED_AT = 'create_dt';
    const UPDATED_AT = 'update_dt';

    // protected $connection = 'mysql';
    // protected $table = 'qiita_api.authors';
}
