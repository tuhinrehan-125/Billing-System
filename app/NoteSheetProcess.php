<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoteSheetProcess extends Model
{
    public function Expense(){
        return $this->hasOne(Expense::class,'id');
    }
}
