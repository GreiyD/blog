<?php

namespace App\Services;

use App\Contracts\ImageStorageServiceContract;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageLocalStorageService implements ImageStorageServiceContract
{
    public function upload(UploadedFile $file, string $path): false|string
    {
        return $file->store($path, 'public');
    }

    public function update(UploadedFile $file, string|null $oldPath , string $path): false|string
    {
        if (isset($oldPath) && Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }
        return $this->upload($file, $path);
    }

    public function delete(string $path)
    {
        return Storage::disk('public')->delete($path);
    }
}
