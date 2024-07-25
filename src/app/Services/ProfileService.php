<?php

namespace App\Services;

use App\Contracts\ImageStorageServiceContract;
use App\Models\Profile;

class ProfileService
{
    protected object $imageStorageService;
    public function __construct(ImageStorageServiceContract $imageStorageService)
    {
        $this->imageStorageService = $imageStorageService;
    }

    public function getProfile(int $profileId): Profile
    {
        return Profile::findOrFail($profileId);
    }

    public function updateProfile(int $profileId, array $data): bool
    {
        $profile = $this->getProfile($profileId);
        if(isset($data['photo'])){
            $data['photo_path'] = $this->imageStorageService->update($data['photo'], $profile->photo_path, 'profile_photos');
            unset($data['photo']);
        }
        return $profile->update($data);
    }
}
