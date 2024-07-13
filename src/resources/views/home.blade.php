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
@endsection
