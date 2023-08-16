<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\category;
use App\Models\order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\User;
class UserController extends Controller
{
   public function index(){
      $order = order::where('user_id',Auth::id())->get();
    return view('frontend.orders.index',compact('order'));
   }


   public function view($id){
      $orders = order::where('id',$id)->where('user_id',Auth::id())->first();

      return view('frontend.orders.view',compact('orders'));
   }

   public function Settings(){
      return view('frontend.settings');
   }

   public function profileStore(request $request){

    if(Auth::user()->address1 == null){
        $user = User::where('id',Auth::id())->first();
        $user->name = $request->input('fname');
        $user->lname = $request->input('lname');
        $user->phone = $request->input('phone');
        $user->address_1 = $request->input('address_1');
        $user->address_2 = $request->input('address_2');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->country = $request->input('country');
        $user->pincode = $request->input('pincode');


        if($request->hasFile('image')){

            $desination_path = public_path('/images/profile/');

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

            $user->profile = 'images/profile/'.$new_image;

       }
        $user->save();

      return redirect('/')->with('status','Profile Set Suucessfully');

   }
}
}
