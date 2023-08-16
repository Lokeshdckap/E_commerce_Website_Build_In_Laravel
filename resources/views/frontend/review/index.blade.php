@extends('auth.layouts.front')

@section('title')
    Write a review
@endsection

@section('container-fluid py-4')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if ($verifed->count() > 0)
                            <h5>Your are writing a review for {{ $product->name }}</h5>
                            <form action="{{url('add-review')}}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <textarea class="form-control" name="user_review" rows="5" placeholder="Write a review"></textarea>
                                <button class="btn btn-primary mt-5" type="submit">Publish</button>
                            </form>
                        @else
                        <div class="alert alert-danger">
                            <h5>Your are not eligible for write a review!</h5>
                            <p>Who can purchase this product write a review about this product</p>
                            <a href="{{url('/')}}">Go to home page</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
