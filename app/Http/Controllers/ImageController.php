<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller;
use App\Image\AllowedContentTypes;
use App\Image\Filters\CircleFilter;
use App\Image\Filters\VintageFilter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Intervention\Image\Exception\ImageException;
use Intervention\Image\ImageManager;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class ImageController extends Controller
{
    private $imageManager;
    private $vintageFilter;
    private $circleFilter;

    public function __construct(
        ImageManager $imageManager,
        VintageFilter $vintageFilter,
        CircleFilter $circleFilter
    ) {
        $this->imageManager = $imageManager;
        $this->vintageFilter = $vintageFilter;
        $this->circleFilter = $circleFilter;
    }

    public function transform(Request $request): Response
    {
        $requestContentType = $request->header('Content-Type');

        if (!in_array($requestContentType, AllowedContentTypes::getAllowedContentTypes())) {
            throw new BadRequestHttpException(
                'Unsupported content type. Header Content-Type must be one of: ' .
                join(', ', AllowedContentTypes::getAllowedContentTypes())
            );
        }

        try {
            $image = $this->imageManager->make($request->getContent());
        } catch (ImageException $exception) {
            throw new BadRequestHttpException('Image couldn\'t be loaded.');
        }

        $image = $image->filter($this->vintageFilter);
        $image = $image->filter($this->circleFilter);

        return (new Response($image->encode(null, 9)))
            ->header('Content-Type', $requestContentType);
    }
}
