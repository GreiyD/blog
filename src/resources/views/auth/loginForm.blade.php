@extends('layouts.app')

@section('title', 'Login')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5 mt-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Login</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{route('login')}}" method="POST" style="background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" id="password" class="form-control" name="password" required>
                                @error('password')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row mt-4 d-flex">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-outline-primary">Sign in</button>
                                </div>
                                <div class="col-md-6 d-flex align-items-center">
                                    <small class="text-muted col-sm-6">If you are not<br>registered yet:</small>
                                    <div class="col-sm-6">
                                        <a href="{{ route('register.form') }}" class="btn btn-outline-primary d-flex justify-content-center">Registration</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
