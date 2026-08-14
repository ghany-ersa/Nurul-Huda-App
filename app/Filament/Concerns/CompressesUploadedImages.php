<?php

namespace App\Filament\Concerns;

use Filament\Forms\Components\FileUpload;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

trait CompressesUploadedImages
{
    /**
     * Compress the uploaded image and re-encode it as JPEG so it stays
     * small enough for link preview crawlers (e.g. WhatsApp) to fetch.
     */
    protected static function compressImageUpload(FileUpload $fileUpload): FileUpload
    {
        return $fileUpload->saveUploadedFileUsing(function (TemporaryUploadedFile $file, FileUpload $component): ?string {
            if (! $file->exists()) {
                return null;
            }

            $basename = pathinfo($component->getUploadedFileNameForStorage($file), PATHINFO_FILENAME);
            $filename = "{$basename}.jpg";

            $path = trim($component->getDirectory().'/'.$filename, '/');

            $image = (new ImageManager(new Driver))
                ->decode($file->get())
                ->scaleDown(width: 1200)
                ->encode(new JpegEncoder(quality: 75));

            $component->getDisk()->put($path, (string) $image, [
                'visibility' => $component->getVisibility(),
            ]);

            return $path;
        });
    }
}
