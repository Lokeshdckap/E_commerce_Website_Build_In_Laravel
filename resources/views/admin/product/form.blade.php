@extends('auth.layouts.admin')

@section('container-fluid py-4')
    <div class="card">
        <div class="card-header">
            <h4>Add Products</h4>
        </div>
        <div class="card-body">
            <form action="{{url('insertproduct')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <select class="form-select" name="cate_id">
                            <option value="">Select a Category</option>
                            @foreach ( $category as $item )
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                          </select>
                    </div>
                    <div class="col-md-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="col-md-6">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" name="slug">
                    </div>
                    <div class="col-md-6">
                        <label for="smalldescription">Small Description</label>
                        <input type="text" class="form-control" name="small_description">
                    </div>
                    <div class="col-md-6">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" name="description">
                    </div>
                    <div class="col-md-6">
                        <label for="original_price">original price</label>
                        <input type="number" class="form-control" name="original_price">
                    </div>
                    <div class="col-md-6">
                        <label for="selling_price">selling price</label>
                        <input type="number" class="form-control" name="selling_price">
                    </div>
                    <div class="col-md-6">
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="col-md-6">
                        <label for="qty">Qty</label>
                        <input type="number" class="form-control" name="qty">
                    </div>
                    <div class="col-md-6">
                        <label for="tax">tax</label>
                        <input type="number" class="form-control" name="tax">
                    </div>
                    <div class="col-md-6">
                        <label for="status">Status</label>
                        <input type="checkbox" name="status">
                    </div>
                    <div class="col-md-6">
                        <label for="trending">Trending</label>
                        <input type="checkbox"  name="trending">
                    </div>
                    <div class="col-md-6">
                        <label for="meta_title">meta_title</label>
                        <input type="text" class="form-control" name="meta_title">
                    </div>
                    <div class="col-md-6">
                        <label for="meta_descrip">meta_description</label>
                        <input type="text" class="form-control" name="meta_description">
                    </div>
                    <div class="col-md-6">
                        <label for="meta_keywords">meta_keyword</label>
                        <input type="text" class="form-control" name="meta_keyword">
                    </div>
                    <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
