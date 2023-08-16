@extends('auth.layouts.front')

@section('title')
    edit a review
@endsection

@section('container-fluid py-4')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                            <h5>Your are writing a review for {{ $review->products->name}}</h5>
                            <form action="{{url('update-review')}}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="review_id" value="{{ $review->id }}">
                                <input type="hidden" name="product_id" value="{{ $review->prod_id }}">
                                <textarea class="form-control" name="user_review" rows="5" placeholder="Write a review">{{$review->user_review}}</textarea>
                                <button class="btn btn-primary mt-5" type="submit">Update</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
