<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\category;
use Illuminate\Support\Facades\File;
class ProductController extends Controller
{
    public function index(){
        $product = Product::all();
        return view('admin.product.index',compact('product'));
    }

    public function addproduct(){
        $category = category::all();
        return view('admin.product.form',compact('category'));
    }


    public function insertproduct(request $request){


        $product = new Product;

        if($request->hasFile('image')){

            $validated = $request->validate([
                'image' => 'required|image|mimes:jpeg,jpg,png,gif|max:512',
            ]);

            $image = $request->file('image');

            $new_image = date('Y-md-d').time().".".$image->extension();

            $desination_path = public_path('/images/products/');

            $image->move($desination_path,$new_image);

            $product->image= 'images/products/'.$new_image;
            }


        $validated = $request->validate([
            'cate_id'=>'required',
            'name' => 'required',
            'slug'=> 'required',
            'small_description'=> 'required',
            'description'=> 'required',
            'original_price'=> 'required',
            'selling_price'=> 'required',
            'qty'=> 'required',
            'tax'=> 'required',
            'meta_title'=> 'required',
            'meta_description'=> 'required',
            'meta_keyword'=> 'required',
        ]);

        $product->cate_id = $request->input('cate_id');
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->small_description = $request->input('small_description');
        $product->description = $request->input('description');
        $product->original_price = $request->input('original_price');
        $product->selling_price = $request->input('selling_price');
        $product->qty = $request->input('qty');
        $product->tax = $request->input('tax');
        $product->status = $request->input('status') == true ?'1':'0';
        $product->trending = $request->input('trending') == true ?'1':'0';
        $product->meta_title = $request->input('meta_title');
        $product->meta_description = $request->input('meta_description');
        $product->meta_keyword = $request->input('meta_keyword');

        $product->save();

        return redirect('product')->with('status','Product Added Sucessfully');
    }

    public function delete($id){

        $product = Product::find($id);

        if($product->image){

            $desination_path = public_path('/images/products/'.$product->image);


            if(File::exists($desination_path))
            {

                File::delete($desination_path);
            }

        }

        $product->delete();
        return redirect('product')->with('status','Deleted Sucessfully');
        }

        public function edit($id){
            $product = Product::find($id);
            return view('admin.product.edit',compact('product'));
        }


        public function updatepro(request $request,$id){


            $product = Product::find($id);

            if($request->hasFile('image')){

                $desination_path = public_path('/images/products/');

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

                $product->image= 'images/products/'.$new_image;

           }


           $product->name = $request->input('name');
           $product->slug = $request->input('slug');
           $product->small_description = $request->input('small_description');
           $product->description = $request->input('description');
           $product->original_price = $request->input('original_price');
           $product->selling_price = $request->input('selling_price');
           $product->qty = $request->input('qty');
           $product->tax = $request->input('tax');
           $product->status = $request->input('status') == true ?'1':'0';
           $product->trending = $request->input('trending') == true ?'1':'0';
           $product->meta_title = $request->input('meta_title');
           $product->meta_description = $request->input('meta_description');
           $product->meta_keyword = $request->input('meta_keyword');

           $product->update();

           return redirect('product')->with('status','Updated Sucessfully');


        }
}
