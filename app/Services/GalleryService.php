<?php

namespace App\Services;

use App\Repositories\GalleryRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageOptimizer;

class GalleryService
{
    protected $galleryRepository;

    public function __construct(GalleryRepository $galleryRepository)
    {
        $this->galleryRepository = $galleryRepository;
    }

    public function getAll(array $fields = ['*'])
    {
        return $this->galleryRepository->getAll($fields);
    }

    public function getActive(array $fields = ['*'])
    {
        return $this->galleryRepository->getActive($fields);
    }

    public function findById(int $id, array $fields = ['*'])
    {
        return $this->galleryRepository->findById($id, $fields);
    }

    public function create(array $data)
    {
        if (isset($data['image_file']) && $data['image_file'] instanceof UploadedFile) {
            $data['path'] = $this->uploadImage($data['image_file']);
        }
        unset($data['image_file']);

        return $this->galleryRepository->create($data);
    }

    public function update(array $data, int $id)
    {
        $gallery = $this->galleryRepository->findById($id, ['id', 'path']);

        if (isset($data['image_file']) && $data['image_file'] instanceof UploadedFile) {
            if (!empty($gallery->path)) {
                $this->deleteImage($gallery->path);
            }
            $data['path'] = $this->uploadImage($data['image_file']);
        }
        unset($data['image_file']);

        return $this->galleryRepository->update($data, $id);
    }

    public function delete(int $id)
    {
        return $this->galleryRepository->delete($id);
    }

    public function uploadImage(UploadedFile $file)
    {
        $path = $file->store('gallery_images', 'public');
        ImageOptimizer::optimize($path);
        return $path;
    }

    public function deleteImage(string $imagePath)
    {
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }
}
