@extends('layouts.app')

@section('title', 'Edit Profile')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5 mt-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Edit Profile</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.edit') }}" method="POST" enctype="multipart/form-data" style="background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 text-center">
                                <img src="{{ asset('storage') . "/$profile->photo_path"}}" alt="User Photo" width="225" height="225">
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">Profile Photo:</label>
                                <input type="file" class="form-control" id="photo" name="photo">
                                @error('photo')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name:</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $profile->full_name }}">
                                @error('full_name')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="age" class="form-label">Age:</label>
                                <input type="number" class="form-control" id="age" name="age" value="{{ $profile->age }}">
                                @error('age')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">City:</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{ $profile->city }}">
                                @error('city')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="info" class="form-label">About Me:</label>
                                <textarea class="form-control" id="info" name="info">{{ $profile->info }}</textarea>
                                @error('info')
                                <div style="color: red;">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="{{route('profile.show')}}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
