@extends('auth.layouts.admin')

@section('container-fluid py-4')
    <div class="card">
        <div class="card-header">
            <h4>Edit Products</h4>
        </div>
        <div class="card-body">
            <form action="{{url('updatepro/'.$product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <select class="form-select">
                            <option value="">{{$product->category->name}}</option>
                          </select>
                    </div>
                    <div class="col-md-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{$product->name}}">
                    </div>
                    <div class="col-md-6">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" name="slug" value="{{$product->slug}}">
                    </div>
                    <div class="col-md-6">
                        <label for="smalldescription">Small Description</label>
                        <input type="text" class="form-control" name="small_description" value="{{$product->small_description}}">
                    </div>
                    <div class="col-md-6">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" name="description" value="{{$product->description}}">
                    </div>
                    <div class="col-md-6">
                        <label for="original_price">original price</label>
                        <input type="number" class="form-control" name="original_price" value="{{$product->original_price}}">
                    </div>
                    <div class="col-md-6">
                        <label for="selling_price">selling price</label>
                        <input type="number" class="form-control" name="selling_price" value="{{$product->selling_price}}">
                    </div>
                    @if ($product->image)
                    <img src="{{url($product->image)}}" style="width: 100px">
                    @else
                    <h1>{{'No Image uploaded'}}</h1>
                    @endif
                    <div class="col-md-6">
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="col-md-6">
                        <label for="qty">Qty</label>
                        <input type="number" class="form-control" name="qty" value="{{$product->qty}}">
                    </div>
                    <div class="col-md-6">
                        <label for="tax">tax</label>
                        <input type="number" class="form-control" name="tax" value="{{$product->tax}}">
                    </div>
                    <div class="col-md-6">
                        <label for="status">Status</label>
                        <input type="checkbox" name="status"  @if ($product->status) checked @else 0
                        @endif >
                    </div>
                    <div class="col-md-6">
                        <label for="trending">Trending</label>
                        <input type="checkbox"  name="trending"  @if ($product->trending) checked @else 0
                        @endif >
                    </div>
                    <div class="col-md-6">
                        <label for="meta_title">meta_title</label>
                        <input type="text" class="form-control" name="meta_title"value="{{$product->meta_title}}">
                    </div>
                    <div class="col-md-6">
                        <label for="meta_descrip">meta_description</label>
                        <input type="text" class="form-control" name="meta_description" value="{{$product->meta_description}}">
                    </div>
                    <div class="col-md-6">
                        <label for="meta_keywords">meta_keyword</label>
                        <input type="text" class="form-control" name="meta_keyword" value="{{$product->meta_keyword}}">
                    </div>
                    <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
