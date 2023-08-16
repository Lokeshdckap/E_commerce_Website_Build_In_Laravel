@extends('auth.layouts.front')

@section('title')
    Welcome to our Category!
@endsection
@section('container-fluid py-4')
<div class="py-3 mb-4 shadow-5m bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">All Categories</h6>
    </div>
</div>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>All Categories</h2>
                    <div class="row">
                        @foreach ($category as $cate)
                            <div class="col-md-3 mb-3">
                                <a href="{{'Category/'.$cate->slug}}">
                                <div class="card">
                                    <img src="{{ $cate->image }}" alt=""  width="251px" height="200px">
                                    <div class="card-body">
                                        <h5>{{ $cate->name }}</h5>
                                        <p>{{$cate->description}}</p>
                                    </div>
                                </div>
                            </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
