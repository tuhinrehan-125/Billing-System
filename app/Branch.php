<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    //

    public function Expenses()
    {
        return $this->belongsTo(Expense::class);
    }
}
