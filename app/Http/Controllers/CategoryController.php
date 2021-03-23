<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

class CategoryController extends Controller
{
    public function data(){
        $category=Category::where('delete_status',1)->paginate(10);
        return view('backend.category',compact('category'));
        return $category;
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
        ]);
        
        // return $request;
        $category=new Category();
        $category->name=$request->name;
        $category->description=$request->description;
        $category->save();
        return $category;
    }
    public function edit($id){
        $category=Category::findOrFail($id);
        return $category;
    }
     public function update(Request $request){
        //  return $request;
         $this->validate($request,[
 
             'name'=>'required',
         ]);
         $category=Category::findOrFail($request->id);
         $category->name=$request->name;
         $category->description=$request->description;
         $category->save();
         return $category;
     }
     public function SoftDelete($id){
     $category=Category::findOrFail($id);
     if ($category->delete_status==1){
         $category->delete_status=0;
     }else{
         $category->delete_status=1;
     }
     $category->save();
     return response()->json(['success']);
 }
}
