@extends('auth.layouts.admin')

@section('container-fluid py-4')
    <div class="card">
        <div class="card-header">
            <h4>Add Category</h4>
        </div>
        <div class="card-body">
            <form action="{{url('insertData')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="col-md-6">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" name="slug">
                    </div>
                    <div class="col-md-6">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" name="description">
                    </div>
                    <div class="col-md-6">
                        <label for="status">Status</label>
                        <input type="checkbox" name="status">
                    </div>
                    <div class="col-md-6">
                        <label for="popular">Popular</label>
                        <input type="checkbox" name="popular">
                    </div>
                    <div class="col-md-6">
                        <label for="meta_title">meta_title</label>
                        <input type="text" class="form-control" name="meta_title">
                    </div>
                    <div class="col-md-6">
                        <label for="meta_descrip">meta_descrip</label>
                        <input type="text" class="form-control" name="meta_descrip">
                    </div>
                    <div class="col-md-6">
                        <label for="meta_keywords">meta_keywords</label>
                        <input type="text" class="form-control" name="meta_keywords">
                    </div>
                    <div class="col-md-12">
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
