@extends('Layouts.app')

@section('title', '$post->title | My laravel 7')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-lg-6">
            <h1>{{$post->title}}</h1>
            <div class="text-secondary">
                <!-- category->name berasal dari table category -->
                <a href="/categories/{{$post->category->slug}}"> {{$post->category->name}}</a> &middot; {{$post->created_at->format('d F, Y')}} &middot;
                @foreach($post->tags as $tag)
                <a href="/tags/{{$tag->slug}}">{{$tag->name}}</a>
                @endforeach
            </div>
            <hr>
            <p>{{$post->body}}</p>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                    delete
                </button>
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