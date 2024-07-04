<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Melihovv\Base64ImageDecoder\Base64ImageDecoder;

function uploadImage($base64Image)
{
    $decoder = new Base64ImageDecoder($base64Image, $allowedFormats = ['jpeg', 'png', 'jpg']);

    $decodedContent = $decoder->getDecodedContent();
    $format = $decoder->getFormat();
    $image = Str::random(10) . '.' . $format;
    Storage::disk('public/image/user')->put($image, $decodedContent);

    return $image;
}
