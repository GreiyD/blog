@extends('layouts.app')

@section('title', 'Home')
@section('content')
    <div class="text-center mt-4">
        <h2>My feed</h2>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="row mt-3">
                @foreach($posts as $post)
                    <div class="col-md-10 mx-auto">
                        @include('post.post-card', ['post' => $post])
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
@endsection
