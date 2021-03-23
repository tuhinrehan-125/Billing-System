<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $filable=[
        'category_id',
        'name',
        'description',
        'delete_status',
    ];
    public function Category(){
        return $this->belongsTo(Category::class ,'category_id');
    }
}
