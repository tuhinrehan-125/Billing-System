<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseDetails extends Model
{
    public function Expense(){
        return $this->belongsTo(Expense::class,'employee_id');
    }
}
