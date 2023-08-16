@extends('auth.layouts.admin')

@section('container-fluid py-4')
    <div class="card">
        <div class="card-header">
            <h4>Category Page</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $cate )
                    <tr>
                        <td>{{$cate->id}}</td>
                        <td>{{$cate->name}}</td>
                        <td>{{$cate->description}}</td>
                        <td><img src="{{url($cate->image)}}" style="width: 100px"></td>
                        <td>
                           <button class="btn" style="background-color: green"><a href="{{'edit/'.$cate->id}}">Edit</a></button>
                           <button class="btn" style="background-color: red"><a href="{{'delete/'.$cate->id}}">Delete</a></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
