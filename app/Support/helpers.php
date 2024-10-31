<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

if (!function_exists('uploadMedia')) {
    function uploadMedia($name, $files, ?Model $model, $clearMedia = false): void
    {
        if ($clearMedia) {
            $model?->clearMediaCollection($name);
        }
        if (is_array($files)) {
            foreach ($files as $file) {
                uploadMedia($name, $file, $model, $clearMedia);
            }
            return;
        }
        if ($files instanceof UploadedFile) {
            $model->addMedia($files)->toMediaCollection($name);
            return;
        }

        // Handle base64 encoded strings
        if (is_string($files) && base64_encode(base64_decode($files, true)) === $files) {
            $model->addMediaFromBase64($files)
                ->usingFileName(Str::finish(Str::random(), '.png'))
                ->toMediaCollection($name);
        }
    }
}
