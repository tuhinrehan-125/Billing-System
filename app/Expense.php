<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{

    protected $fillable = [
        'id', 'category_id', 'totao_expense', 'paid', 'due'


    ];

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function SubCategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }
    public function Employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function NoteSheet()
    {
        return $this->hasOne(NoteSheetProcess::class, 'notesheet_id');
    }
    public function Banks()
    {
        return $this->belongsTo(Bank::class);
    }

    public function Branches(){
        return $this->belongsTo(Branch::class);
    }

}
