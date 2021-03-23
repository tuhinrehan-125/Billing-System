<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

use Brian2694\Toastr\Facades\Toastr;
use App\SubCategory;

class SubCategoryController extends Controller
{
    public function data(){
        $SubCategory=SubCategory::with('Category')->where('delete_status',1)->get();
    //    dd($SubCategory);
        $category=Category::where('delete_status',1)->paginate(10);
        return view('backend.sub-category',compact('SubCategory','category'));
    }
    public function store(Request $request){
        // return $request;
        $this->validate($request,[
            'category_id'=>'required',
            'name'=>'required',
        ]);
        $SubCategory=new SubCategory();
        $SubCategory->name=$request->name;
        $SubCategory->category_id=$request->category_id;
        $SubCategory->description=$request->description;
        $SubCategory->save();
        Toastr::success('Sub Category Created','Success');
        return back();
        return response()->json(['success']);
    }
    public function edit($id){
        $SubCategory=SubCategory::findOrFail($id);
        return $SubCategory;
    }
     public function update(Request $request){
         $this->validate($request,[
 
             'name'=>'required',
             'category_id'=>'required', 
         ]);
         $SubCategory=SubCategory::findOrFail($request->id);
         $SubCategory->name=$request->name;
         $SubCategory->category_id=$request->category_id;
         $SubCategory->description=$request->description;
         $SubCategory->save();
         Toastr::success('Sub Category Updated','Success');
        return back();
         return response()->json(['success']);
     }
     public function SoftDelete($id){
        $SubCategory=SubCategory::findOrFail($id);
        if ($SubCategory->delete_status==1){
            $SubCategory->delete_status=0;
        }else{
            $SubCategory->delete_status=1;
        }
        $SubCategory->save();
        Toastr::success('Sub Category Deleted','Success');
        return back();
        return response()->json(['success']);
    }
}
