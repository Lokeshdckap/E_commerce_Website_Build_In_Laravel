@extends('auth.layouts.admin')

@section('title')
    My Orders
@endsection
@section('container-fluid py-4')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h5 class="text-white">Order View</h5>
                        <a href="{{ url('orders') }}" class="float-end text-white">Back</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Shipping Details</h5>
                                <hr>
                                <label for="">First Name</label>
                                <div class="border p-2">{{ $orders->name }}</div>
                                <label for="">Last Name</label>
                                <div class="border p-2">{{ $orders->lname }}</div>
                                <label for="">Email</label>
                                <div class="border p-2">{{ $orders->email }}</div>
                                <label for="">Contact</label>
                                <div class="border p-2">{{ $orders->phone }}</div>
                                <label for="">Shipping Address</label>
                                <div class="border p-2">
                                    {{ $orders->address_1 }}
                                    {{ $orders->address_2 }}
                                    {{ $orders->city }}
                                    {{ $orders->state }}
                                    {{ $orders->country }}
                                </div>
                                <label for="">Zip Code</label>
                                <div class="border p-2">{{ $orders->pincode }}</div>
                            </div>
                            <div class="col-md-6">
                                <h5>Order Details</h5>
                                <hr>
                                <table class="table table=bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders->orderItems as $items)
                                            <tr>
                                                <td>{{ $items->products->name }}</td>
                                                <td>{{ $items->qty }}</td>
                                                <td>{{ $items->price }}</td>
                                                <td> <img src="{{ url($items->products->image) }}" alt=""
                                                        style="width: 100px" height="75px"></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h4 class="float-end">Grand Total: Rs {{ $orders->total }}</h4>
                                <label for="">Order Status</label>
                                <form action="{{url('update-order/'.$orders->id)}}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <select class="form-select" name="order_status">
                                        <option value="0" {{ $orders->order_status == '0' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="1" {{ $orders->order_status == '1' ? 'selected' : '' }}>Completed
                                        </option>
                                    </select>
                                    <button class="btn btn-primary mt-5" type="submit" >
                                        Update
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
