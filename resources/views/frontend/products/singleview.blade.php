@extends('auth.layouts.front')

@section('title')
    {{ $product->name }}
@endsection
@section('container-fluid py-4')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('/add-rating') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $product->id }}" class="prod_id" name="prod_id">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Rate {{ $product->name }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="rating-css">
                            <div class="star-icon">
                                @if ($rating_user)
                                    @for ($i = 1; $i <= $rating_user->stars_rated; $i++)
                                        <input type="radio" value="{{ $i }}" name="product_rating" checked
                                            id="rating{{ $i }}">
                                        <label for="rating{{ $i }}" class="fa fa-star"></label>
                                    @endfor
                                    @for ($j = $rating_user->stars_rated + 1; $j <= 5; $j++)
                                        <input type="radio" value="{{ $j }}" name="product_rating"
                                            id="rating{{ $j }}">
                                        <label for="rating{{ $j }}" class="fa fa-star"></label>
                                    @endfor
                                @else
                                    <input type="radio" value="1" name="product_rating" checked="rating1">
                                    <label for="rating1" class="fa fa-star"></label>
                                    <input type="radio" value="2" name="product_rating" id="rating2">
                                    <label for="rating2" class="fa fa-star"></label>
                                    <input type="radio" value="3" name="product_rating" id="rating3">
                                    <label for="rating3" class="fa fa-star"></label>
                                    <input type="radio" value="4" name="product_rating" id="rating4">
                                    <label for="rating4" class="fa fa-star"></label>
                                    <input type="radio" value="5" name="product_rating" id="rating5">
                                    <label for="rating5" class="fa fa-star"></label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="py-3 mb-4 shadow-5m bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">All Categories/{{ $product->category->name }}/{{ $product->name }}</h6>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 border-right">
                <img src="{{ url($product->image) }}" class="w-100" alt="">
            </div>
            <div class="col-md-8">
                <h2 class="mb-0">
                    {{ $product->name }}
                    @if ($product->trending)
                        <label style="font-size: 16px" class="float-end badge bg-danger trending_tag">Trending</label>
                    @endif
                </h2>
                <hr>
                <label class="me-3">Original Price : <s>Rs {{ $product->original_price }}</s> </label>
                <p class="fw-bold">Selling Price : Rs {{ $product->selling_price }}</p>
                @php $ratings_num =  number_format($rating_value) @endphp
                <div class="rating">
                    @if ($ratings->count() > 0)
                        <span>{{ $ratings->count() }} Ratings</span>
                    @else
                        No Ratings
                    @endif

                    @for ($i = 1; $i <= $ratings_num; $i++)
                        <i class="fa fa-star"></i>
                    @endfor
                    @for ($j = $ratings_num + 1; $j <= 5; $j++)
                        <i class="fa fa-star black"></i>
                    @endfor
                </div>
                <p class="mt-3">
                    {{ $product->small_description }}
                </p>
                <hr>
                @if ($product->qty > 0)
                    <label class="badge bg-success">In stock</label>
                @else
                    <label class="badge bg-danger">Out of stock</label>
                @endif

                <div class="row mt-2">
                    <div class="col-md-2">
                        <input type="hidden" value="{{ $product->id }}" class="prod_id">
                        <label for="Quantity">Quantity</label>
                        <div class=" text-center mb-3" style="display: flex">
                            <button class="input-group-text decrement">-</button>
                            <input type="text" name="quantity" value="1" class="form-control qty-btn" />
                            <button class="input-group-text increment">+</button>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <br />
                        @if ($product->qty > 0)
                            <button type="button" class="btn btn-primary me-3 float-start addtoCartBtn">Add to Cart <i
                                    class="fa-solid fa-cart-shopping"></i></button>
                            <a href="{{url('/checkoutView')}}" class="btn btn-warning me-3 float-start">Buy now <i class="fa-solid fa-bolt"></i></a>
                        @endif
                        <button type="button" class="btn btn-success me-3 float-start addToWishList">Add to wishlist <i
                        class="fa-solid fa-heart"></i></button>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <button type="button" class="btn btn-link  me-3 mt-4 rate" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Rate this Product
                    </button>
                    <a href="{{ url('add-review/' . $product->slug . '/userreview') }}"
                        class="btn btn-link  me-3 mt-4 rate">
                        Write a review
                    </a>
                </div>
                <div class="col-md-8">
                    @foreach ($reviews as $review)
                        <div class="user-review">
                            <label for="">{{ $review->users->name . ' ' . $review->users->lname }}</label>
                            @if ($review->user_id == Auth::id())
                                <a href="{{url('edit-review/'.$product->slug.'/userreview')}}">Edit</a>
                            @endif
                            <br>
                            @if($review->ratings)
                            @php
                                $user_rated = $review->ratings->stars_rated;
                            @endphp
                            @for ($i = 1; $i <= $user_rated; $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                            @for ($j = $user_rated + 1; $j <= 5; $j++)
                                <i class="fa fa-star black"></i>
                            @endfor
                            @endif
                            <small>Reviewed on {{$review->created_at->format('d M Y')}}</small>
                            <p>{{$review->user_review}}</p>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>
@endsection
