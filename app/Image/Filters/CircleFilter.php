<?php

namespace App\Image\Filters;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

final class CircleFilter implements FilterInterface
{
    public function applyFilter(Image $image): Image
    {
        $image->circle(
            $image->height() / 2,
            $image->width() / 2,
            $image->height() / 2,
            function ($draw) {
                $draw->border(15, '123456');
            }
        );

        return $image;
    }
}
