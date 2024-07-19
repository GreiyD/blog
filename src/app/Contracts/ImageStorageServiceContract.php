<?php

namespace App\Contracts;

use Illuminate\Http\UploadedFile;

interface ImageStorageServiceContract
{
    public function upload(UploadedFile $file, string $path);

    public function update(UploadedFile $file, string|null $oldPath , string $path);

    public function delete(string $path);
}
