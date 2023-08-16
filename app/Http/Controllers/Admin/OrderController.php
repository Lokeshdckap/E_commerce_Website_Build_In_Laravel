<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\order;
class OrderController extends Controller
{
    public function orders(){
       $orders = order::where('order_status','0')->get();
        return view('admin.orders.index',compact('orders'));
    }


    public function view($id){

        $orders = order::where('id',$id)->first();

        return view('admin.orders.view',compact('orders'));
    }

    public function updateOrder(request $request,$id){

        $orders = order::find($id);

        $orders->order_status = $request->input('order_status');

        $orders->update();

        return redirect('orders')->with('status','Status Update Successfully');
    }

    public function orderHistory(){
        $orders = order::where('order_status','1')->get();
        return view('admin.orders.history',compact('orders'));
    }
}
