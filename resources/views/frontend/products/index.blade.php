@extends('auth.layouts.front')

@section('title')
{{$categories->name}}
@endsection
@section('container-fluid py-4')
<div class="py-3 mb-4 shadow-5m bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">All Categories/{{$categories->name}}</h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <h3>{{$categories->name}}</h3>
                @foreach ($product as $products)
                    <div class="col-md-3 mb-5">
                        <a href="{{'/Category'.'/'.$categories->slug.'/'.$products->slug}}">
                        <div class="card">
                            <img src="{{url($products->image)}}" alt="">
                            <div class="card-body">
                                <h5>{{ $products->name }}</h5>
                                <span class="float-start">{{ $products->selling_price }}</span>
                                <span class="float-end"><s>{{ $products->original_price }}</s></span>
                            </div>
                        </div>
                        </a>
                    </div>
                @endforeach
        </div>
    </div>
</div>
@endsection
