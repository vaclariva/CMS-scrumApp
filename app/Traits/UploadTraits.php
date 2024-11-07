<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadTraits
{
    /**
     * Upload the file with slugging to a given path
     *
     * @param UploadedFile $image
     * @param $path
     * @return string
     */
    public function uploadFile($image)
    {
        if (!$image) {
            return null;
        }

        $extension = $image->getClientOriginalExtension();
        $image_name = $image->hashName();
        // $filePath = Carbon::now()->format('Y/m/d/');
        $filePath = 'users/photo/';
        Storage::disk('public')->putFileAs($filePath, $image, $image_name);

        return $filePath . $image_name;
    }

    /**
     * Handling delete file.
     */
    public function deleteFile(?string $path): null
    {
        try {
            if ($path != null) {
                Storage::disk(config('filesystems.default'))->exists($path)
                ? Storage::disk(config('filesystems.default'))->delete($path)
                : null;

                return null;
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            info($th);

            return null;
        }
    }
}
