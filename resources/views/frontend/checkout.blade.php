@extends('auth.layouts.front')

@section('title')
    Checkout
@endsection

@section('container-fluid py-4')
<div class="py-3 mb-4 shadow-5m bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('/')}}">
                Home
            </a>/
            <a href="{{url('/checkoutView')}}">
                Checkout
            </a>
        </h6>
    </div>
</div>
    <div class="container mt-5">
        <form method="POST" action="{{url('place-order')}}">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h6>Basic Details</h6>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="firstName" style="font-weight: 700">First Name</label>
                                <input type="text" class="form-control firstName" placeholder="Enter First Name" id="firstName" name="fname" value="{{Auth::user()->name}}">
                                <span id="fname_error"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control lastName" placeholder="Enter Last Name" id="lastName" name="lname" value="{{Auth::user()->lname}}">
                                <span id="lname_error"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="Email">Email</label>
                                <input type="text" class="form-control email" placeholder="Enter Email" id="Email" name="email" value="{{Auth::user()->email}}">
                                <span id="email_error"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="number" class="form-control phone" placeholder="Enter Phone Number"
                                    id="phoneNumber" name="phone" value="{{Auth::user()->phone}}">
                                <span id="phone_error"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="Address1">Address 1</label>
                                <input type="text" class="form-control address1" placeholder="Enter Address 1" id="Address1" name="address_1" value="{{Auth::user()->address_1}}">
                                <span id="address1_error"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="Address1">Address 2</label>
                                <input type="text" class="form-control address2" placeholder="Enter Address 2" id="Address2" name="address_2" value="{{Auth::user()->address_2}}">
                                <span id="address2_error"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="city">City</label>
                                <input type="text" class="form-control city" placeholder="Enter City" id="city" name="city" value="{{Auth::user()->city}}">
                                <span id="city_error"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="State">State</label>
                                <input type="text" class="form-control state" placeholder="Enter State" id="State" name="state" value="{{Auth::user()->state}}">
                                <span id="state_error"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="country">Country</label>
                                <input type="text" class="form-control country" placeholder="Enter Country" id="country" name="country" value="{{Auth::user()->country}}">
                                <span id="country_error"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="pincode">Pincode</label>
                                <input type="number" class="form-control pincode" placeholder="Enter pincode" id="pincode" name="pincode" value="{{Auth::user()->pincode}}">
                                <span id="pincode_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h6>order details</h6>
                        <hr>
                        @if ($cartItems->count() > 0)
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $cartItem)
                                    <tr>
                                        <td>{{ $cartItem->products->name }}</td>
                                        <td>{{ $cartItem->prod_qty }}</td>
                                        <td>{{ $cartItem->products->selling_price * $cartItem->prod_qty }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <input type="hidden" name="payment_mode" value="COD">
                        <button type="submit" class="btn btn-success  w-100 float-center">Place Order | COD</button>
                        <button type="button" class="btn btn-primary mt-3 w-100 float-left razorpay_btn">Pay with Razorpay</button>
                        <div id="paypal-buttons-container"></div>
                        @else
                          <h2>No Products in Cart</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @csrf
    </form>
    </div>
@endsection
@section('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id=AQlghCiOjewIMsZA1rUpc_zzIlcZchlaPUkDm3z951DxF75SwZIKT9TxiKxjQBXEJGV0_u00WfdvyJ4W"></script>
{{-- <script>
   paypal.Buttons({
  createOrder() {
    // This function sets up the details of the transaction, including the amount and line item details.
    return fetch("/my-server/create-paypal-order", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        cart: [
          {
            sku: "YOUR_PRODUCT_STOCK_KEEPING_UNIT",
            quantity: "YOUR_PRODUCT_QUANTITY"
          }
        ]
      })
    });
  },
  onApprove(data) {
    // This function captures the funds from the transaction.
    return fetch("/my-server/capture-paypal-order", {
      method: "POST",
      body: JSON.stringify({
        orderID: data.orderID
      })
    })
    .then((response) => response.json())
    .then((details) => {
      // This function shows a transaction success message to your buyer.
      alert('Transaction completed by ' + details.payer.name.given_name);
    });
  }
}).render('#paypal-button-container');
  </script> --}}
@endsection
