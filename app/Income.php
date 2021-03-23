<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    public function Project(){
        return $this->belongsTo(Project::class,'project_id');
    }
    public function Employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
