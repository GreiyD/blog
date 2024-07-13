@extends('layouts.app')

@section('title', 'Registration')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5 mt-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Registration</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('register') }}" method="POST" style="background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                            @csrf
                            <div class="mb-3">
                                <label for="nickname" class="form-label">Name:</label>
                                <input type="text" id="nickname" class="form-control" name="nickname" value="{{ old('nickname') }}" required>
                                @error('nickname')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
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
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password:</label>
                                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required>
                                @error('password_confirmation')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-outline-primary">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
