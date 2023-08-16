<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Review;
use App\Models\category;
use Illuminate\Support\Facades\Auth;
class FrontendController extends Controller
{
    public function index(){
        $products =Product::where('trending','1')->take(15)->get();

        $trendingCategory = category::where('popular','1')->take(15)->get();

        return view('frontend.index',compact('products','trendingCategory'));
    }

    public function category(){
        $category =category::where('status','0')->get();
        return view('frontend.category',compact('category'));
    }


    public function viewCategory($slug){

        if(category::where('slug',$slug)->exists()){

         $categories = category::where('slug',$slug)->first();

         $product = Product::where('cate_id',$categories->id)->where('status','0')->get();

         return view('frontend.products.index',compact('categories','product'));
        }

        else{
            return redirect('/')->with('status','Slug Not Exists');
        }

    }

    public function viewProduct($cate_slug,$prod_slug){

        if(category::where('slug',$cate_slug)->exists()){

            if(Product::where('slug',$prod_slug)->exists()){

              $product = Product::where('slug',$prod_slug)->first();

              $ratings = Rating::where('prod_id',$product->id)->get();

              $rating_sum = Rating::where('prod_id',$product->id)->sum('stars_rated');

              $rating_user = Rating::where('prod_id',$product->id)->where('user_id',Auth::id())->first();

              $reviews = Review::where('prod_id',$product->id)->get();

              if($ratings->count() > 0){

                $rating_value = $rating_sum / $ratings->count();

              }
              else{
                $rating_value = 0;
              }

              return view('frontend.products.singleview',compact('product','ratings','rating_value','rating_user','reviews'));
            }

            else{
                return redirect('/')->with('status','This link not working');
            }
    }
    else{
        return redirect('/')->with('status','No Category Found');
    }
 }

   public function prodcutListUsingAjax(){
    $products =Product::select('name')->where('status','0')->get();

    $allDatas = [];

     foreach($products as $product){
        $allDatas[] = $product['name'];
     }
     return $allDatas;
   }

   public function searchProduct(request $request){
         $search_product = $request->input('product_name');

         if($search_product !=""){

            $product = Product::where('name',"LIKE","%$search_product%")->first();

            if($product){
                return redirect('Category/'.$product->category->slug.'/'.$product->slug);
            }

            else{
                return redirect()->back()->with('status','No requestProducts Found !');
            }
         }

         else{
            return redirect()->back();
         }
   }
}
