<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\GalleryService;
use App\Services\SettingService;

class GalleryController extends Controller
{
    protected $galleryService;
    protected $settingService;

    public function __construct(GalleryService $galleryService, SettingService $settingService)
    {
        $this->galleryService = $galleryService;
        $this->settingService = $settingService;
    }

    public function index()
    {
        $photos = $this->galleryService->getActive();

        $setting = $this->settingService->getByPage('gallery', ['payload']);
        $gallerySettings = $setting ? $setting->payload : [
            'site_title' => 'Mal Bali Galeria | Gallery',
            'page_title' => 'Mall Gallery',
            'page_subtitle' => 'Capture the vibrant moments, events, and shopping experiences at Mal Bali Galeria.',
            'grid_columns' => 4,
            'initial_images' => 8,
            'load_more_increment' => 4,
            'enable_zoom' => '1',
            'enable_download' => '1',
            'enable_share' => '1',
        ];

        return view('frontend.gallery.index', compact('photos', 'gallerySettings'));
    }
}
