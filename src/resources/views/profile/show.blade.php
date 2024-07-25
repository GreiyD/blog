@extends('layouts.app')

@section('title', 'Profile')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>User Profile</h2>
                    </div>
                    <div class="card-body d-flex align-items-center">
                        <div class="me-4">
                            <img src="{{ asset('storage') . "/$profile->photo_path"}}" alt="User Photo" width="225" height="225">
                        </div>
                        <div>
                            <div class="mb-3">
                                <h3>{{ $profile->full_name ?? 'Nothing to say' }}</h3>
                            </div>
                            <div class="mb-3">
                                <h5>Age:</h5>
                                <p>{{ $profile->age ?? 'Nothing to say' }}</p>

                                <h5>City:</h5>
                                <p>{{ $profile->city ?? 'Nothing to say' }}</p>

                                <h5>About Me:</h5>
                                <p>{{ $profile->info ?? 'Nothing to say' }}</p>
                            </div>
                            <div class="d-flex">
                                <a href="{{route('profile.edit', $profile->id)}}" class="btn btn-primary me-2">Edit Profile</a>
                                <form action="" method="POST" onsubmit="return confirm('Are you sure you want to delete your account?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete Account</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
