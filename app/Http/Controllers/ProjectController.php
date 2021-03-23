<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Brian2694\Toastr\Facades\Toastr;

class ProjectController extends Controller
{
    public function data(){
        $project=Project::where('delete_status',1)->paginate(10);
        return view('backend.project',compact('project'));
    }
    public function store(Request $request){
        // $this->validate($request,[
        //     'name'=>'required',
        //     'phone'=>'required',
        //     'email'=>'required',
        //     'address'=>'required',
        //     'designation'=>'required',
        //     'image'=>'nullable|image|mimes:jpg,jpeg,png|max:200',
        // ]);
        // return $request;
        $project=new Project();
        $project->project_name=$request->project_name;
        $project->project_details=$request->project_details;
        $project->project_value=$request->project_value;
        $project->start_day=$request->start_day;
        $project->end_day=$request->end_day;
        $project->company_name=$request->company_name;
        $project->phone=$request->phone;
        $project->email=$request->email;
        $project->address=$request->address;
        // $project->user_id=Auth::user()->id;
        $image=$request->file('image');
        if ($image){
            $imageName='/backend/project-image/'.uniqid().$image->getClientOriginalExtension();
            $image->move(public_path() . '/backend/project-image', $imageName);
            $project->image=$imageName;
        }
        $project->save();
        Toastr::success(' Project Created','Success');
        return back();
        return response()->json(['success']);
    }
    public function edit($id){
        $project=Project::findOrFail($id);
        return $project;
    }
     public function update(Request $request){
        //  return $request;
        //  $this->validate($request,[
        //     'name'=>'required',
        //     'phone'=>'required',
        //     'email'=>'required',
        //     'address'=>'required',
        //     'designation'=>'required',
        //     'image'=>'nullable|image|mimes:jpg,jpeg,png|max:200',
        //  ]);
         $project=Project::findOrFail($request->id);
         $project->project_name=$request->project_name;
        $project->project_details=$request->project_details;
        $project->project_value=$request->project_value;
        $project->start_day=$request->start_day;
        $project->end_day=$request->end_day;
        $project->company_name=$request->company_name;
        $project->phone=$request->phone;
        $project->email=$request->email;
        $project->address=$request->address;
         $image=$request->file('image');
         if ($image){
             $imageName='/backend/project-image/'.uniqid().$image->getClientOriginalExtension();
             if(!empty($image->image)) {
                 if (file_exists(public_path( $image->image))) {
                     unlink(public_path( $image->image));
                 }
             }
             $image->move(public_path() . '/backend/project-image', $imageName);
             $project->image=$imageName;
         }
         $project->save();
         Toastr::success(' Project Update','Success');
        return back();
         return response()->json(['success']);
     }
     public function SoftDelete($id){
     $project=Project::findOrFail($id);
     if ($project->delete_status==1){
         $project->delete_status=0;
     }else{
         $project->delete_status=1;
     }
     $project->save();
     $project->save();
         Toastr::success(' Project Deleted','Success');
     return response()->json(['success']);
 }
}
