@extends('auth.layouts.front')

@section('title')
    My Orders
@endsection
@section('container-fluid py-4')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>My Orders</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table=bordered">
                            <thead>
                                <tr>
                                    <th>Tracking No</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $order as $orders )
                                  <tr>
                                    <td>{{$orders->tracking_no}}</td>
                                    <td>{{$orders->total}}</td>
                                      @if ($orders->order_status)
                                     <td>{{'Completed'}}</td>
                                     @else
                                     <td>{{'Pending'}}</td>
                                      @endif
                                    <td> <a href="{{url('view-order/'.$orders->id)}}" class="btn btn-primary">View</a></td>
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
