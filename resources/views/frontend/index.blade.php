@extends('auth.layouts.front')

@section('title')
    Welcome to our website!
@endsection

@section('container-fluid py-4')
    @include('auth.layouts.inc.slider')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <h3>Feature Products</h3>
                <div class="owl-carousel owl-theme">
                    @foreach ($products as $product)
                        <div class="item">
                            <div class="card">
                                <img src="{{ url($product->image) }}" alt=""  width="80px" height="200px">
                                <div class="card-body">
                                    <h5>{{ $product->name }}</h5>
                                    <span class="float-start">{{ $product->selling_price }}</span>
                                    <span class="float-end"><s>{{ $product->original_price }}</s></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <h3>Trending Category</h3>
                <div class="owl-carousel owl-theme">
                    @foreach ($trendingCategory as $trendingCategories)
                        <div class="item">
                            <a href="{{'Category/'.$trendingCategories->slug}}">
                            <div class="card">
                                <img src="{{ $trendingCategories->image }}" alt="" width="80px" height="200px">
                                <div class="card-body">
                                    <h5>{{ $trendingCategories->name }}</h5>
                                    <p>{{$trendingCategories->description}}</p>
                                </div>
                            </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots:false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        })
    </script>
@endsection
