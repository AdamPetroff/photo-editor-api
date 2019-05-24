<?php

namespace App\Image;

final class AllowedContentTypes
{
    private const IMAGE_JPEG = 'image/jpeg';
    private const IMAGE_PNG = 'image/png';

    public static function getAllowedContentTypes(): array
    {
        return [
            self::IMAGE_JPEG,
            self::IMAGE_PNG
        ];
    }
}
