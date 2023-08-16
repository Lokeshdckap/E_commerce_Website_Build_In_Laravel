<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\category;
use App\Models\cart;
use Illuminate\Support\Facades\Auth;
class CartController extends Controller
{

    public function addProduct(Request $request){

        $product_id = $request->input('prod_id');
        $qty = $request->input('qty');

        if(Auth::check()){

           $prod_check = Product::where('id',$product_id)->first();

           if($prod_check){

            if(cart::where('prod_id',$product_id)->where('user_id',Auth::id())->exists()){

              return response()->json(['status'=>'Already Added to cart']);
            }
            else{
              $cartItem = new cart;
              $cartItem->prod_id =  $product_id;
              $cartItem->user_id = Auth::id();
              $cartItem->prod_qty = $qty;
              $cartItem->save();
              return response()->json(['status'=>'Added to cart']);
           }
          }
        }
        else{
            return response()->json(['status'=>'Login to continue']);
        }
    }


    public function viewCart(){
        $cartItems = cart::where('user_id',Auth::id())->get();
        return view('frontend.cart',compact('cartItems'));
    }

    public function deletePro(request $request){

        if(Auth::check()){
         $prod_id = $request->input('prod_id');

         if(cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists()){
            $cart = cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
            $cart->delete();
            return response()->json(['status'=>'Deleted Successfully']);
         }
        }

        else{
            return response()->json(['status'=>'Login to continue']);
        }
    }


    public function updateQty(request $request){
      $prod_id = $request->input('prod_id');
      $product_qty = $request->input('prod_qty');

      if(Auth::check()){

        if(cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists()){

            $cart = cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();

            $cart->prod_qty = $product_qty;

            $cart->update();

            return response()->json(['status'=>'Updated Successfully']);

      }
      }
    }

    public function cartCount(){
        $cartCount = cart::where('user_id',Auth::id())->count();
        return response()->json(['count'=> $cartCount]);

    }
}
