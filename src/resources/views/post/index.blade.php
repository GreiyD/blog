@extends('layouts.app')

@section('title', 'My Posts')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
                <div class="row mt-5">
                    @foreach($posts as $post)
                        <div class="col-md-10">
                            @include('post.post-card', ['post' => $post])
                        </div>
                    @endforeach
                </div>
        </div>
    </div>
@endsection
