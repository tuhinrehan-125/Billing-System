<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function Designation(){
        return $this->belongsTo(Designation::class, 'designation');
    }
}
