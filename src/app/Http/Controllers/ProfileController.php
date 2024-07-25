<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Services\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    protected object $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function show(int $profileId): View
    {
        $profile = $this->profileService->getProfile($profileId);
        return view('profile.show', compact('profile'));
    }

    public function edit(int $profileId): View
    {
        $profile = $this->profileService->getProfile($profileId);
        return view('profile.edit', compact('profile'));
    }

    public function update(ProfileRequest $request, int $profileId): RedirectResponse
    {
        $data = $request->only('full_name', 'age', 'city', 'info', 'photo');
        $this->profileService->updateProfile($profileId, $data);

        return redirect()->route('profile.show', ['profile' => $profileId]);
    }
}
