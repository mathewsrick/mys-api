<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $table = 'address';
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = [
        'default' => 'boolean',
    ];
}
