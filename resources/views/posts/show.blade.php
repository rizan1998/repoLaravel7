@extends('Layouts.app')

@section('title', '$post->title | My laravel 7')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-lg-8">
            @if($post->thumbnail)
            <img class="card-img-top img-thumbnail w-100" style="height:550px; object-fit: cover; object-position:center;" src="{{asset($post->takeImage())}}" alt="">
            @endif
            <h1>{{$post->title}}</h1>
            <div class="text-secondary">
                <!-- category->name berasal dari table category -->
                <a href="/categories/{{$post->category->slug}}"> {{$post->category->name}}</a> &middot; {{$post->created_at->format('d F, Y')}} &middot;
                @foreach($post->tags as $tag)
                <a href="/tags/{{$tag->slug}}">{{$tag->name}}</a>
                @endforeach
            </div>
            <div class="media">
                <img width="60" class="rounded-circle mr-3" src="{{$post->author->gravatar()}}" alt="">
                <div class="media-body">
                    <div>
                        {{$post->author->name}}
                    </div>
                    {{'@'. $post->author->email}}
                </div>
            </div>
            <hr>
            <p>{!! nl2br($post->body) !!}</p>
            @if(auth()->user()->id == $post->user_id)
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                    delete
                </button>
                @can('update', $post)
                <!-- $post adalah parameter untuk masuk ke policynya-->
                <a href="/posts/{{$post->slug}}/edit" class="btn ml-2 btn-warning btn-sm"> Edit </a>
                @endcan

            </div>
            @endif

        </div>
        <div class="col-lg-4">
            @foreach($posts as $post)
            <div class="card mb-2">
                <div class="card-body">
                    <div class="text-secondary">
                        <small>
                            <a href="/categories/{{$post->category->slug}}"> {{$post->category->name}}</a> &middot;
                            @foreach($post->tags as $tag)
                            <a href="/tags/{{$tag->slug}}">{{$tag->name}}</a>
                            @endforeach
                        </small>
                    </div>
                    <div>
                        <h5> {{Str::limit($post->title, 20, '.')}}</h5>
                        {{Str::limit($post->body, 50, '.')}}
                    </div>
                    <div class="d-flex justify-content-between align-item-center mb-2">
                        <div class="media align-items-center">
                            <img width="20" class="rounded-circle mr-3" src="{{$post->author->gravatar()}}" alt="">
                            <div class="media-body">
                                <div>
                                    {{$post->author->name}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>

</div>
</div>

@endsection



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/posts/{{$post->slug}}/delete" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    apakah anda yakin ingin menghapus data {{$post->title}}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Save changes</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>

    </div>
</div>
</div>