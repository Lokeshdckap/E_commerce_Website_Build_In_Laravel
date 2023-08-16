<?php

namespace App\Http\Controllers\frontend;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\order;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
class RatingController extends Controller
{
    public function add(request $request){

     $stars_rated = $request->input('product_rating');
     $product_id = $request->input('prod_id');

     $prod_check = Product::where('id',$product_id)->where('status',0)->first();
     if($prod_check){

         $verifed = order::where('orders.user_id',Auth::id())
         ->join('order_items','orders.id','order_items.order_id')
         ->where('order_items.prod_id',$product_id)->get();

         if($verifed->count() > 0){

            $exist_rating = Rating::where('user_id',Auth::id())->where('prod_id',$product_id)->first();

            if($exist_rating){

                $exist_rating->stars_rated = $stars_rated;
                $exist_rating->update();

            }
            else{
            Rating::create([
                'user_id'=>Auth::id(),
                'prod_id'=>$product_id,
                'stars_rated'=>$stars_rated

            ]);
            }
            return redirect()->back()->with('status','Rated Sucessfully Thank you for rating !');
        }
        else{
            return redirect()->back()->with('status','You cannot rate this product without buy a product');
         }
     }
     else{
        return redirect()->back()->with('status','link is not working !');
     }
    }
}
