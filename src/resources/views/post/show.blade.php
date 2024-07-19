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
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                            </div>
                            <div class="col-6 text-end">
                                <form action="" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="type" value="1">
                                    <button type="submit" class="btn btn-outline-success">
                                        Like: {{ $post->likes }}
                                    </button>
                                </form>

                                <form action="" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="type" value="0">
                                    <button type="submit" class="btn btn-outline-danger">
                                        Dislike: {{ $post->dislikes }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
