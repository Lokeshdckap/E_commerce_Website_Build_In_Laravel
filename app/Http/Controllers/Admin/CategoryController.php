<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\Hash;
class CategoryController extends Controller
{
    public function index(){
        $category = category::all();
        return view('admin.category.index',compact('category'));
    }


    public function addcategory(){
        return view('admin.category.form');
    }

    public function insertData(request $request){

        $category = new category;
        if($request->hasFile('image')){

            $validated = $request->validate([
                'image' => 'required|image|mimes:jpeg,jpg,png,gif|max:512',
            ]);

            $image = $request->file('image');

            $new_image = date('Y-md-d').time().".".$image->extension();

            $desination_path = public_path('/images');

            $image->move($desination_path,$new_image);

            $category->image= 'images/'.$new_image;

            }

        $validated = $request->validate([
            'name' => 'required',
            'slug'=> 'required',
            'meta_title'=> 'required',
            'meta_descrip'=> 'required',
            'meta_keywords'=> 'required',
        ]);


        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == true ?'1':'0';
        $category->popular = $request->input('popular') == true ?'1':'0';
        $category->meta_title = $request->input('meta_title');
        $category->meta_descrip = $request->input('meta_descrip');
        $category->meta_keywords = $request->input('meta_keywords');

         $category->save();

         return redirect('/dashboard')->with('status','Category Added Sucessfully');
    }

    public function delete($id){
        
    $category = category::find($id);

    if($category->image){

        $desination_path = public_path('images/'.$category->image);


        if(File::exists($desination_path))
        {

            File::delete($desination_path);
        }

    }

    $category->delete();
    return redirect('/category')->with('status','Deleted Sucessfully');
    }

    public function edit($id){
        $category = category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    public function update(request $request,$id){
        $category = category::find($id);

        if($request->hasFile('image')){

            $desination_path = public_path('images/'.$category->image);

            if(File::exists($desination_path)){
                File::delete($desination_path);
            }


            $validated = $request->validate([
                'image' => 'required|image|mimes:jpeg,jpg,png,gif|max:512',
            ]);

            $image = $request->file('image');

            $new_image = date('Y-md-d').time().".".$image->extension();

            $desination_path = public_path('/images');

            $image->move($desination_path,$new_image);

            $category->image= 'images/'.$new_image;

       }
            $category->name = $request->input('name');
            $category->slug = $request->input('slug');
            $category->description = $request->input('description');
            $category->status = $request->input('status') == true ?'1':'0';
            $category->popular = $request->input('popular') == true ?'1':'0';
            $category->meta_title = $request->input('meta_title');
            $category->meta_descrip = $request->input('meta_descrip');
            $category->meta_keywords = $request->input('meta_keywords');

            $category->update();

            return redirect('/dashboard')->with('status','Updated Sucessfully');

        }

    }

