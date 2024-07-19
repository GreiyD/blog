@extends('layouts.app')

@section('title', 'Edit Post')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Edit Post</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{route('posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="title" class="form-label">Title:</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" required autofocus>
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">Content:</label>
                                <textarea class="form-control" id="content" name="content" rows="18" required>{{ old('content', $post->content) }}</textarea>
                                @error('content')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">Photo:</label>
                                <input type="file" class="form-control-file" id="photo" name="photo">
                                @error('photo')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @if ($post->photo_path)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $post->photo_path) }}" alt="Current Photo" width="200">
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update Post</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
