<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Expense;
use App\Category;
use App\SubCategory;
use App\Employee;
use App\Project;
use App\Income;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
class IncomeController extends Controller
{
    public function data(){
        $income=Income::where('delete_status',1)->paginate(10);
        return view('backend.income.index',compact('income'));
    }
    public function dataProject($id){
       return  $income=Project::findOrFail($id);
        // return view('backend.income.index',compact('income'));
    }
    public function Create(){
       $project=Project::where('delete_status',1)->get();
       $employee=Employee::where('delete_status',1)->get();
        return view('backend.income.create',compact('project','employee'));
    }
    public function store(Request $request){
        // return $request;
        $this->validate($request,[
            'project_id'=>'required',
            'employee_id'=>'required',
            'total_amount'=>'required',
            'working_day'=>'required',
            'paid'=>'required',
            'due'=>'required',
        ]);

        $total=$request->total_amount;
        $paid=$request->paid;
        $due=$request->due;
        if($due <0){
            Toastr::error('Your paid value is not valid','Error');
            return back();
        }
        $income=new Income();
        $income->employee_id=$request->employee_id;
        $income->project_id=$request->project_id;
        $income->total_amount=$request->total_amount;
        $income->working_day=$request->working_day;
        $income->paid=$request->paid;
        $income->due=$request->due;
        $income->comments=$request->comments;
        $income->date=date('m-d-Y');
        $income->user_id=Auth::user()->id;
        $income->save();
        Toastr::success('Income Information','Success');
        return back();
        // return $income;
    }
    public function edit($id){
        $employee=Employee::where('delete_status',1)->get();
        $project=Project::where('delete_status',1)->get();
        $income=Income::findOrFail($id);
      return view('backend.income.edit',compact('project','income','employee'));
    }
     public function update(Request $request){
        //  return $request;
        //  $this->validate($request,[
        //      'name'=>'required',
        //  ]);
        $income=Income::findOrFail($request->income_id);
        $income->employee_id=$request->employee_id;
        $income->project_id=$request->project_id;
        $income->total_amount=$request->total_amount;
        $income->paid=$request->paid;
        $income->due=$request->due;
        $income->comments=$request->comments;
        $income->date=date('m-d-Y');
        $income->user_id=Auth::user()->id;
        $income->save();
        Toastr::success('Income Information Updated','Success');
        return back();
     }
     public function SoftDelete($id){
        //  return $id;
     $income=Income::findOrFail($id);
     if ($income->delete_status==1){
         $income->delete_status=0;
    }else{
         $income->delete_status=1;
    }
     $income->save();
     Toastr::success('Income Information Delete','Success');
     return back();
     return response()->json(['success']);
 }
}
