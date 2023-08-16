<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\order;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
class ReviewController extends Controller
{
    public function add($product_slug){

        $product = Product::where('slug',$product_slug)->where('status','0')->first();

        if($product){

            $prod_id = $product->id;

            $review = Review::where('user_id',Auth::id())->where('prod_id',$prod_id)->first();

            if($review){
                return view('frontend.review.edit',compact('review'));

            }

            else{
            $verifed = order::where('orders.user_id',Auth::id())
            ->join('order_items','orders.id','order_items.order_id')
            ->where('order_items.prod_id',$prod_id)->get();

            return view('frontend.review.index',compact('product','verifed'));
            }
        }

        else{
           return redirect()->back()->with('status','link is not working !');
        }

    }


    public function addReview(request $request){

       $product_id = $request->input('product_id');

       $product = Product::where('id',$product_id)->where('status','0')->first();

        if($product){

            $user_review = $request->input('user_review');

            $new_review = Review::create([
                'user_id' => Auth::id(),
                'prod_id' => $product_id,
                'user_review' => $user_review
            ]);


            $cate_slug = $product->category->slug;

            $pro_slug = $product->slug;

            if($new_review){
                return redirect('Category/'.$cate_slug.'/'.$pro_slug)->with('status',"Thank you for writing");
            }
        }

        else{
           return redirect()->back()->with('status','link is not working !');
        }
    }

    public function editReview($prod_slug){

        $product = Product::where('slug',$prod_slug)->where('status','0')->first();

        if($product){

            $prod_id = $product->id;

            $review = Review::where('user_id',Auth::id())->where('prod_id',$prod_id)->first();

            if($review){
            return view('frontend.review.edit',compact('review'));

            }
            else{
                return redirect()->back()->with('status','link is not working !');
            }
        }

        else{
            return redirect()->back()->with('status','link is not working !');
        }

    }

    public function updateReview(request $request){

        $user_review = $request->input('user_review');

        $product_id = $request->input('product_id');

        $product = Product::where('id',$product_id)->where('status','0')->first();

        if($user_review != ""){

            $review_id = $request->input('review_id');

            $review = Review::where('user_id',Auth::id())->where('id',$review_id)->first();

            if($review){
                $review->user_review = $user_review;

                $review->update();


            $cate_slug = $product->category->slug;

            $pro_slug = $product->slug;

            return redirect('Category/'.$cate_slug.'/'.$pro_slug)->with('status',"Thank you for Update your review !");


            }
        }
        else{
            return redirect()->back()->with('status','You Cannot Empty Review Submit !');
        }
    }
}
