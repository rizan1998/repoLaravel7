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

        </div>
        <div>
            @if(Auth::check())
            <a href="/posts/create" class="btn btn-primary"> Add New Post</a>
            @endif
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-7">
            @forelse($post as $p)

            <div class="card mb-3">
                <!-- asset('storage/' . $p->thumbnail) -->
                <a href="{{route('posts.show', $p->slug)}}">
                    <img class="card-img-top img-thumbnail" style="height:380px; object-fit: cover; object-position:center;" src="{{asset($p->takeImage())}}" alt="">
                </a>
                <div class="card-body">

                    <div class="text-secondary">
                        <small>
                            <a href="/categories/{{$p->category->slug}}"> {{$p->category->name}}</a> &middot;
                            @foreach($p->tags as $tag)
                            <a href="/tags/{{$tag->slug}}">{{$tag->name}}</a>
                            @endforeach
                        </small>
                    </div>
                    <div>
                        <h5> {{Str::limit($p->title, 20, '.')}}</h5>
                        {{Str::limit($p->body, 200, '.')}}
                        <hr>
                    </div>
                    <div class="d-flex justify-content-between align-item-center">
                        <div class="media align-items-center">
                            <img width="40" class="rounded-circle mr-3" src="{{$p->author->gravatar()}}" alt="">
                            <div class="media-body">
                                <div>
                                    {{$p->author->name}}
                                </div>
                            </div>
                        </div>
                        <div class="text-secondary mt-2">
                            <small>
                                Published on {{$p->created_at->diffForHumans()}}
                            </small>
                        </div>
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
    </div>


    <div class="d-flex justify-content-center">
        <div>
            {{$post->links()}}
        </div>
    </div>
</div>


@endsection