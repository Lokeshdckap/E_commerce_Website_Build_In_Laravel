@extends('auth.layouts.admin')

@section('container-fluid py-4')
    <div class="card">
        <div class="card-header">
            <h4>Edit Category</h4>
        </div>
        <div class="card-body">
            <form action="{{url('update/'.$category->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" value="{{$category->name}}" name="name">
                    </div>
                    <div class="col-md-6">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" value="{{$category->slug}}" name="slug">
                    </div>
                    <div class="col-md-6">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" value="{{$category->description}}" name="description">
                    </div>
                    <div class="col-md-6">
                        <label for="status">Status</label>
                        <input type="checkbox" name="status" @if ($category->status) checked @else 0
                        @endif>
                    </div>
                    <div class="col-md-6">
                        <label for="popular">Popular</label>
                        <input type="checkbox" name="popular"  @if ($category->popular) checked @else 0
                        @endif>
                    </div>
                    <div class="col-md-6">
                        <label for="meta_title">meta_title</label>
                        <input type="text" class="form-control" name="meta_title" value="{{$category->meta_title}}">
                    </div>
                    <div class="col-md-6">
                        <label for="meta_descrip">meta_descrip</label>
                        <input type="text" class="form-control" name="meta_descrip" value="{{$category->meta_descrip}}">
                    </div>
                    <div class="col-md-6">
                        <label for="meta_keywords">meta_keywords</label>
                        <input type="text" class="form-control" name="meta_keywords" value="{{$category->meta_keywords}}">
                    </div>
                    @if ($category->image)
                    <img src="{{url($category->image)}}" style="width: 100px">
                    @else
                    <h1>{{'No Image uploaded'}}</h1>
                    @endif
                    <div class="col-md-12">
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
