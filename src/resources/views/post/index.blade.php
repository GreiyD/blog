@extends('layouts.app')

@section('title', 'My Posts')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="row">
                    @foreach($posts as $post)
                        @include('post.post-card', ['post' => $post])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
