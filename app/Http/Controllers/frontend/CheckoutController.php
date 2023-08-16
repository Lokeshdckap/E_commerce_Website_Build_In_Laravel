<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\cart;
use App\Models\Product;
use App\Models\order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class CheckoutController extends Controller
{
    public function index(){
        $Old_cartItems = cart::where('user_id',Auth::id())->get();


        foreach($Old_cartItems as $item){

        if(!Product::where('id',$item->prod_id)->where('qty',">=",$item->prod_qty)->exists()){

             $removeItem = cart::where('user_id',Auth::id())->where('prod_id',$item->prod_id)->first();

             $removeItem->delete();
        }
        }

        $cartItems = cart::where('user_id',Auth::id())->get();

        return view('frontend.checkout',compact('cartItems'));
    }


    public function placeOrder(Request $Request){
      $order = new order;
      $order->user_id = Auth::id();
      $order->name = $Request->input('fname');
      $order->email =  $Request->input('email');
      $order->lname = $Request->input('lname');
      $order->phone = $Request->input('phone');
      $order->address_1 = $Request->input('address_1');
      $order->address_2 = $Request->input('address_2');
      $order->city = $Request->input('city');
      $order->state = $Request->input('state');
      $order->country = $Request->input('country');
      $order->pincode = $Request->input('pincode');
      $order->payment_mode = $Request->input('payment_mode');
      $order->payment_id = $Request->input('payment_id');


      $order->tracking_no = 'commerce'.rand(1111,9999);

            // to calculate the total price:

            $total = 0;

            $cartItems_total = cart::where('user_id',Auth::id())->get();

            foreach($cartItems_total as $prod_total){

             $total += $prod_total->products->selling_price * $prod_total->prod_qty;

            }

            $order->total = $total;

      $order->save();

      $cartItems = cart::where('user_id',Auth::id())->get();



      foreach($cartItems as $items){
        OrderItem::create([
         'order_id' => $order->id,
         'prod_id'  => $items->prod_id,
         'qty'      => $items->prod_qty,
         'price'   =>  $items->products->selling_price
        ]);

        $prod = Product::where('id',$items->prod_id)->first();

        $prod->qty = $prod->qty - $items->prod_qty;

        $prod->update();
      }

      if(Auth::user()->address1 == null){
      $user = User::where('id',Auth::id())->first();
      $user->name = $Request->input('fname');
      $user->lname = $Request->input('lname');
      $user->phone = $Request->input('phone');
      $user->address_1 = $Request->input('address_1');
      $user->address_2 = $Request->input('address_2');
      $user->city = $Request->input('city');
      $user->state = $Request->input('state');
      $user->country = $Request->input('country');
      $user->pincode = $Request->input('pincode');
      $user->update();
      }
      $cartItems = cart::where('user_id',Auth::id())->get();

      cart::destroy($cartItems );

      if($Request->input('payment_mode') == 'Paid by Razorpay'){
        return response()->json(['status' => "Order Placed Successfully"]);
      }

      return redirect('/')->with('status','Order Placed Successfully');
    }


    public function proceedToPay(request $request){

        $cartItems = cart::where('user_id',Auth::id())->get();

        $total_price = 0;
        foreach($cartItems as $item){
         $total_price += $item->products->selling_price * $item->prod_qty;
        }

        $firstname =      $request->input('firstname');
        $lname     =      $request->input('lname');
        $email     =      $request->input('email');
        $phone     =      $request->input('phone');
        $address1  =      $request->input('address1');
        $address2  =      $request->input('address2');
        $city      =      $request->input('city');
        $state     =      $request->input('state');
        $country   =      $request->input('country');
        $pincode   =      $request->input('pincode');



        return response()->json([
            'firstname' =>$firstname,
            'lname'=> $lname,
            'email'=> $email,
            'phone'=> $phone,
            'address1'=> $address1,
            'address2'=> $address2,
            'city'=> $city,
            'state'=> $state,
            'country'=> $country,
            'pincode'=> $pincode,
            'total_price'=> $total_price
        ]);
    }
}
