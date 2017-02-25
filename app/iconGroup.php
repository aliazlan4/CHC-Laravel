<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class iconGroup extends Model
{
    protected $table = 'iconGroups';

    protected $fillable = [
        'name'
    ];
}
