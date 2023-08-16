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
            <a href="{{url('/profile')}}">
                profile
            </a>
        </h6>
    </div>
</div>
    <div class="container mt-5">
        <form method="POST" action="{{url('profile-set')}}" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h6>Profile Settings</h6>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="firstName" style="font-weight: 700">First Name</label>
                                <input type="text" class="form-control firstName" placeholder="Enter First Name" id="firstName" name="fname" value="{{Auth::user()->name}}">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control lastName" placeholder="Enter Last Name" id="lastName" name="lname" value="{{Auth::user()->lname}}">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="Email">Email</label>
                                <input type="text" class="form-control email" placeholder="Enter Email" id="Email" name="email" value="{{Auth::user()->email}}">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="number" class="form-control phone" placeholder="Enter Phone Number"
                                    id="phoneNumber" name="phone" value="{{Auth::user()->phone}}">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="Address1">Address 1</label>
                                <input type="text" class="form-control address1" placeholder="Enter Address 1" id="Address1" name="address_1" value="{{Auth::user()->address_1}}">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="Address1">Address 2</label>
                                <input type="text" class="form-control address2" placeholder="Enter Address 2" id="Address2" name="address_2" value="{{Auth::user()->address_2}}">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="city">City</label>
                                <input type="text" class="form-control city" placeholder="Enter City" id="city" name="city" value="{{Auth::user()->city}}">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="State">State</label>
                                <input type="text" class="form-control state" placeholder="Enter State" id="State" name="state" value="{{Auth::user()->state}}">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="country">Country</label>
                                <input type="text" class="form-control country" placeholder="Enter Country" id="country" name="country" value="{{Auth::user()->country}}">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="pincode">Pincode</label>
                                <input type="number" class="form-control pincode" placeholder="Enter pincode" id="pincode" name="pincode" value="{{Auth::user()->pincode}}">
                            </div>
                            @if (Auth::user()->profile)
                            <img src="{{url(Auth::user()->profile)}}" style="width: 100px">
                            @else
                            <h4 class="mt-3">{{'No Image uploaded'}}</h5>
                            @endif
                            <div class="col-md-6 mt-3">
                                <label for="profile">Profile Image</label>
                                <input type="file" class="form-control profile"  id="profile" name="image" >
                            </div>
                            <div class="col-md-6 mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @csrf
    </form>
    </div>
@endsection
