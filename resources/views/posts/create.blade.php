@extends('Layouts.app')

@section('title', 'create | My Laravel 7')

@section('content')
<div class="container">
    <div class="row">
        <div class=" mt-3 col-lg-6">
            @include('alert.alert')
            <h3>Add New Post</h3>
            <form method="post" action="/posts/store">
                @csrf
                @include('posts.form', ['submit' => 'Create'])
            </form>
        </div>
    </div>
</div>

@endsection