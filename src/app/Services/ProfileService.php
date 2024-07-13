<?php

namespace App\Services;

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
    public function getUserProfile(): Profile
    {
        return Auth::user()->profile;
    }

    public function editProfile($profile, array $data): void
    {
        $profile->update($data);
    }

    public function editProfilePhoto($profile, $photo): void
    {
        if ($profile->photo_path && Storage::disk('public')->exists($profile->photo_path)) {
            Storage::disk('public')->delete($profile->photo_path);
        }
        $path = $photo->store('profile_photos', 'public');
        $profile->update(['photo_path' => $path]);
    }
}
