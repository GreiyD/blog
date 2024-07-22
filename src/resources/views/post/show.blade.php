@extends('layouts.app')

@section('title', 'Post')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mt-5">
                <div class="card mb-5">
                    @if($post->photo_path)
                        <div class="px-2">
                            <img src="{{ asset('storage/' . $post->photo_path) }}" class="card-img-top mt-2" alt="Post photo">
                        </div>
                    @endif
                    <div class="card-body">
                        <h3 class="card-title">{{ $post->title }}</h3>
                        <small class="text-muted">Added: {{ $post->created_at->format('d M Y H:i') }}</small>
                        <p class="card-text mt-3">{!! nl2br(e($post->content)) !!}</p>

                        <div class="row justify-content-between">
                            <div class="col-6 text-start">
                                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back</a>
                            </div>
                            <div class="col-6 text-end">
                                <a type="button" class="btn btn-outline-success" href="" onclick="event.preventDefault(); document.getElementById('like').submit();">
                                    Like:{{$post->likes}}
                                </a>
                                <form id="like" action="{{route('posts.reaction', $post->id)}}" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="reaction" value="1">
                                </form>

                                <a type="button" class="btn btn-outline-danger" href="" onclick="event.preventDefault(); document.getElementById('dislike').submit();">
                                    Dislike:{{$post->dislikes}}
                                </a>
                                <form id="dislike" action="{{route('posts.reaction', $post->id)}}" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="reaction" value="0">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
