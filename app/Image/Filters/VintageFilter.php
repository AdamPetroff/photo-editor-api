<?php

namespace App\Image\Filters;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

final class VintageFilter implements FilterInterface
{
    public function applyFilter(Image $image): Image
    {
        $image->greyscale()->pixelate(3);

        return $image;
    }
}
