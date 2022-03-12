<?php
declare(strict_types=1);

namespace App\Http\Builders;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageFacade;
use Intervention\Image\Image;

class ImageBuilder
{
    public const IMAGE_FORMAT = 'png';
    public const FONT_FILE_PATH = 'build/fonts/VL-Gothic-Regular.ttf';

    private string $imageFileName;

    public function generateWelcomeImage(string $name, string $imageUrl): ImageBuilder
    {
        $image = ImageFacade::make($imageUrl);

        $message = "ようこそ\n${name} さん";

        $image->resize(400, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $image->brightness(-20);

        $image->text($message, 0, 0, function ($font) {
            $font->file(public_path(self::FONT_FILE_PATH));
            $font->size(50);
            $font->color('#ffffff');
            $font->valign('middle');
        });

        $this->saveImage($image);

        return $this;
    }

    private function saveImage(Image $image): void
    {
        $this->imageFileName = implode('.', [uniqid(), self::IMAGE_FORMAT]);
        $path = implode(DIRECTORY_SEPARATOR, [Storage::path('public'), $this->imageFileName]);
        $image->save($path, 100, self::IMAGE_FORMAT);
    }

    public function getImageFileName(): string
    {
        return $this->imageFileName;
    }
}
