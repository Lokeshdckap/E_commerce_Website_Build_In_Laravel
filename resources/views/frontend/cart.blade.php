@extends('auth.layouts.front')

@section('title')
    Welcome to cart
@endsection
@section('container-fluid py-4')
<div class="py-3 mb-4 shadow-5m bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('/')}}">
                Home
            </a>/
            <a href="{{url('cart')}}">
                Cart
            </a>
        </h6>
    </div>
</div>
 <div class="container my-5">
    <div class="card shadow">
        <div class="card-body">
            @if ($cartItems->count() > 0)

            <div class="row">
                @php
                 $total = 0;
                @endphp
                @foreach ($cartItems as $cartItem)
                <div class="col-md-2">
                    <img src="{{url($cartItem->products->image)}}" height="70px" width="150px" alt="">
                </div>
                <div class="col-md-3">
                    <h6>{{$cartItem->products->name}}</h6>
                </div>
                <div class="col-md-2">
                    <h6> Rs : {{$cartItem->products->selling_price }}</h6>
                </div>
                <div class="col-md-2">
                    @if($cartItem->products->qty >= $cartItem->prod_qty)
                    <input type="hidden" class="prod_id" value="{{$cartItem->prod_id}}">
                    <label for="Quantity">Quantity</label>
                    <div class=" text-center mb-3" style="display: flex" style="width: 130px" >
                        <button class="input-group-text decrement changeQty">-</button>
                        <input type="number" name="quantity" value="{{$cartItem->prod_qty}}" class="form-control qty-btn"/>
                        <button class="input-group-text increment changeQty">+</button>
                    </div>
                    @php
                    $total += $cartItem->products->selling_price * $cartItem->prod_qty;
                   @endphp
                   @else
                   <h4>Out Of Stock</h4>
                   @endif
                </div>
                <div class="col-md-2">
                    <button class="btn btn-danger delete-cart-item"><i class="fa-solid fa-trash"></i> Remove</button>
                </div>
                @endforeach
            </div>
            <div class="card-footer">
                <h6>Total Price : {{$total}}</h6>
                <a href="{{url('/checkoutView')}}" class="btn btn-success float-end">Proceed to checkout</a>
            </div>
            @else
                <div class="card-body text-center">
                    <h2>Your Shopping cart is empty</h2>
                    <a href="{{url('categories')}}" class="btn btn-outline-primary float-end">Continue Shopping</a>
                </div>
            @endif
        </div>
    </div>
 </div>
@endsection
