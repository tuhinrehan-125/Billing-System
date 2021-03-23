<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Designation;
use Brian2694\Toastr\Facades\Toastr;

class EmployeeController extends Controller
{
    public function data(){
        $employee=Employee::where('delete_status',1)->paginate(10);
        $designation=Designation::where('delete_status',1)->get();
        return view('backend.employee',compact('employee','designation'));
    }
    public function store(Request $request){
        // return $request;
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'address'=>'required',
            'designation'=>'required',
            // 'image'=>'image|mimes:jpg,jpeg,png|max:200',
        ]);
        // return $request;
        $employee=new Employee();
        $employee->name=$request->name;
        $employee->phone=$request->phone;
        $employee->email=$request->email;
        $employee->address=$request->address;
        $employee->designation=$request->designation;
        $employee->joining_date=$request->joining_date;
        // $employee->user_id=Auth::user()->id;
        $image=$request->file('image');
        if ($image){
            $imageName='/backend/employee-image/'.uniqid().$image->getClientOriginalExtension();
            $image->move(public_path().'/backend/employee-image', $imageName);
            $employee->image=$imageName;
        }
        $employee->save();
        Toastr::success('Employee','success');
        return back();
        return response()->json(['success']);
    }
    public function edit($id){
        $employee=Employee::findOrFail($id);
        return $employee;
    }
    public function update(Request $request){
        //  return $request;
        $this->validate($request,[
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'address'=>'required',
            'designation'=>'required',
            'image'=>'nullable|image|mimes:jpg,jpeg,png|max:200',
        ]);
        $employee=Employee::findOrFail($request->id);
        $employee->name=$request->name;
        $employee->phone=$request->phone;
        $employee->email=$request->email;
        $employee->address=$request->address;
        $employee->designation=$request->designation;
        $employee->joining_date=$request->joining_date;
        $image=$request->file('image');
        if ($image){
            $imageName='/backend/Employee-image/'.uniqid().$image->getClientOriginalExtension();
            if(!empty($image->image)) {
                if (file_exists(public_path( $image->image))) {
                    unlink(public_path( $image->image));
            }
            }
            $image->move(public_path() . '/backend/Employee-image', $imageName);
            $employee->image=$imageName;
        }
        $employee->save();
        Toastr::success('Employee','success');
        return back();
        return response()->json(['success']);
    }
    public function SoftDelete($id){
    $employee=Employee::findOrFail($id);
    if ($employee->delete_status==1){
        $employee->delete_status=0;
    }else{
        $employee->delete_status=1;
    }
    $employee->save();
    Toastr::success('Employee','success');
    return back();
    return response()->json(['success']);
}
}
