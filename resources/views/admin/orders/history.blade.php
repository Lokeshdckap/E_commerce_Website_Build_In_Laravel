@extends('auth.layouts.admin')

@section('title')
orders
@endsection
@section('container-fluid py-4')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Order History
                            <a href="{{url('orders')}}" class="btn text-dark float-end">New Orders</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table table=bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Tracking No</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $orders as $order )
                                  <tr>
                                    <td>{{date('d-m-Y',strtotime($order->created_at))}}</td>
                                    <td>{{$order->tracking_no}}</td>
                                    <td>{{$order->total}}</td>
                                      @if ($order->order_status)
                                     <td>{{'Completed'}}</td>
                                     @else
                                     <td>{{'Pending'}}</td>
                                      @endif
                                    <td> <a href="{{url('admin/view-order/'.$order->id)}}" class="btn btn-primary">View</a></td>
                                  </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
