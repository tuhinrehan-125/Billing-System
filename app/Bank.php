<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    //
    // public function bankId()
    // {
    //     return $this->belongsTo(Category::class, 'id');
    // }
    // public function bankName()
    // {
    //     return $this->belongsTo(SubCategory::class, 'bank_name');
    // }
    // public function bankAccount()
    // {
    //     return $this->belongsTo(Employee::class, 'bank_account');
    // }
    public function Expenses()
    {
        return $this->belongsTo(Expense::class);
    }
}
