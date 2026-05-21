<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\GalleryService;

class GalleryController extends Controller
{
    protected $galleryService;

    public function __construct(GalleryService $galleryService)
    {
        $this->galleryService = $galleryService;
    }

    public function index()
    {
        $photos = $this->galleryService->getActive();

        return view('frontend.gallery.index', compact('photos'));
    }
}
