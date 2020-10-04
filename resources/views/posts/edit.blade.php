@extends('Layouts.app')

@section('title', 'create | My Laravel 7')

@section('content')
<div class="container">
    <div class="row">
        <div class=" mt-3 col-lg-6">
            @include('alert.alert')
            <h3>Edit Post</h3>
            <form method="post" action="/posts/{{$post->slug}}/edit" autocomplete="off">
                @csrf
                @method('PATCH')
                @include('posts.form', ['submit' => 'Update'])
            </form>
        </div>
    </div>
</div>

@endsection