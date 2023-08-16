@extends('auth.layouts.front')

@section('title')
    Wishlist
@endsection
@section('container-fluid py-4')
    <div class="container py-5">
        <div class="card shadow">
            <h4>My Wishlist</h4>
            <div class="card-body">
                @if ($wishlist->count()>0)
                <div class="row">
                    @foreach ($wishlist as $cartItem)
                    <div class="col-md-2">
                        <img src="{{url($cartItem->products->image)}}" height="70px" width="150px" alt="">
                    </div>
                    <div class="col-md-2">
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
                            <button class="input-group-text decrement">-</button>
                            <input type="number" name="quantity" value="1" class="form-control qty-btn"/>
                            <button class="input-group-text increment">+</button>
                        </div>
                         {{-- <h4>In Stock</h4> --}}
                       @else
                       <h4>Out Of Stock</h4>
                       @endif
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-danger remove-wishlist"><i class="fa-solid fa-trash"></i> Remove</button>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary addtoCartBtn"><i class="fa-solid fa-shopping-cart"></i> Add to cart</button>
                    </div>
                    @endforeach
                </div>
                @else
                    <div class="card-body text-center">
                        <h2>Your Shopping Wishlist is empty</h2>
                        <a href="{{ url('categories') }}" class="btn btn-outline-primary float-end">Continue Shopping</a>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
