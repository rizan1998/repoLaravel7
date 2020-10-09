@extends('Layouts.app')
@section('title', 'Home')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
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
</div>



@endsection
