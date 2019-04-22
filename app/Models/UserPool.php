<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPool extends Model
{
    //
    protected $table = 'user_pool';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'pool_id', 'status',
    ];

}
