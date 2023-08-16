@extends('auth.layouts.admin')

@section('container-fluid py-4')
    <div class="card">
        <div class="card-header">
            <h4>Product Page</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Selling price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product as $Products )
                    <tr>
                        <td>{{$Products->id}}</td>
                        <td>{{$Products->category->name}}</td>
                        <td>{{$Products->name}}</td>
                        <td>{{$Products->selling_price}}</td>
                        <td><img src="{{url($Products->image)}}" style="width: 50px" height="75px"></td>
                        <td>
                           <button class="btn btn-sm" style="background-color: green"><a href="{{'editpro/'.$Products->id}}">Edit</a></button>
                           <button class="btn btn-sm" style="background-color: red"><a href="{{'deletepro/'.$Products->id}}">Delete</a></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
