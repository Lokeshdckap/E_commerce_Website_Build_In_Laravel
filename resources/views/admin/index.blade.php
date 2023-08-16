@extends('auth.layouts.admin')
@section('title')
@endsection
@section('container-fluid py-4')
    <div class="card">
        <div class="card-body">
            @if (Session::has('status'))
                <h3>{{ Session::get('status') }}</h3>
            @endif
            <h1>Hello {{auth()->user()->name }}</h1>
        </div>
    </div>
@endsection
