@extends('layouts.app')

@section('title', 'Home')
@section('content')
    <h1>Welcome,
        @if (Auth::check())
            {{ Auth::user()->nickname }}
        @else
            Guest
        @endif
    </h1>
{{--    <div class="container mt-5">--}}
{{--        <div class="row justify-content-center">--}}
{{--            @foreach($post as $post)--}}
{{--                <div class="col-md-8">--}}
{{--                    @include('post.post', ['post' => $post])--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
