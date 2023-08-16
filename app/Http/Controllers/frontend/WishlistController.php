<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
class WishlistController extends Controller
{
    public function viewWish(){

        $wishlist = Wishlist::where('user_id',Auth::id())->get();
        return view('frontend.wishlist.view',compact('wishlist'));
    }


    public function addProduct(request $request){

        $product_id = $request->input('prod_id');


        if(Auth::check()){

            $prod_check = Product::where('id',$product_id)->first();

            if($prod_check){

                if(Wishlist::where('prod_id',$product_id)->where('user_id',Auth::id())->exists()){

                    return response()->json(['status'=>'Already Added to Wishlist']);
                  }

                  else{
                    $wishlist = new Wishlist;
                    $wishlist->prod_id =  $product_id;
                    $wishlist->user_id = Auth::id();
                    $wishlist->save();

                    return response()->json(['status'=>'Added to Wishlist']);

                  }

              }


        }
        else{
            return response()->json(['status'=>'Login to continue']);
        }
    }


    public function deletePro(request $request){

        if(Auth::check()){
         $prod_id = $request->input('prod_id');

         if(Wishlist::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists()){
            $wish = Wishlist::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
            $wish->delete();
            return response()->json(['status'=>'Deleted Successfully']);
         }
        }

        else{
            return response()->json(['status'=>'Login to continue']);
        }
    }

    public function wishCount(){
        $wishCount = Wishlist::where('user_id',Auth::id())->count();
        return response()->json(['count'=> $wishCount]);
    }
}
