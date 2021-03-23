<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $filable=[

        'name',
        'description',
        'delete_status'
    ];
}
