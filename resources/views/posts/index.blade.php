@extends('Layouts.app')

@section('title', 'index | My Laravel 7')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-lg-6">
            @include('alert.alert')
        </div>
    </div>
    <div class="d-flex mt-3 mb-2 justify-content-between">
        <div>
            @isset($category)
            <h4>Category: {{$category->name}}</h4>
            @endisset
            @isset($tag)
            <h4>Tag: {{$tag->name}}</h4>
            @endisset

            @if(!isset($tag) && !isset($category))
            <h4>All Post(data)</h4>
            @endif
            <hr>
        </div>
        <div>
            @if(Auth::check())
            <a href="/posts/create" class="btn btn-primary"> Add New Post</a>
            @endif
        </div>
    </div>
    <div class="row">
        @forelse($post as $p)
        <div class="col-sm-4">
            <div class="card mb-3">
                <div class="card-header">
                    {{Str::limit($p->title, 20, '.')}}
                </div>
                <!-- asset('storage/' . $p->thumbnail) -->
                <img class="card-img-top" style="height:270px; object-fit: cover; object-position:center;" src="{{asset($p->takeImage())}}" alt="">
                <div class="card-body">
                    <div>
                        {{Str::limit($p->body, 50, '.')}}
                    </div>
                    <a href="posts/{{$p->slug}}">Read More</a>
                    <p>{{$p->author->name}}</p>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    Published on {{$p->created_at->diffForHumans()}}

                    @can('update', $post)
                    <!-- $post adalah parameter untuk masuk ke policynya-->
                    <a href="/posts/{{$p->slug}}/edit" class="btn btn-warning btn-sm"> Edit </a>
                    @endcan

                </div>
            </div>
        </div>
        @empty
        <div class="col-sm-8 justify-content-senter">
            <div class="alert alert-danger">
                you dont have any post
            </div>
        </div>
        @endforelse
    </div>
    <div class="d-flex justify-content-center">
        <div>
            {{$post->links()}}
        </div>
    </div>
</div>


@endsection