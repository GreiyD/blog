<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileEditFormRequest;
use App\Services\ProfileService;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(ProfileService $profileService):View
    {
        $profile = $profileService->getUserProfile();
        return view('profile.profile', ['profile' => $profile]);
    }

    public function showEditForm(ProfileService $profileService):View
    {
        $profile = $profileService->getUserProfile();

        return view('profile.profile_edit', ['profile' => $profile]);
    }

    public function edit(ProfileEditFormRequest $request, ProfileService $profileService)
    {
        $data = $request->only('full_name', 'age', 'city', 'info');
        $profile = $profileService->getUserProfile();

        if($request->hasFile('photo')){
            $photo = $request->file('photo');
            $profileService->editProfilePhoto($profile, $photo);
        }
        $profileService->editProfile($profile, $data);

        return redirect()->route('profile.show');
    }
}
