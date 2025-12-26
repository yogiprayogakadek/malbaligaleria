<?php

namespace App\Services;

use App\Repositories\PromoRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PromoService
{

    protected $promoRepository;

    public function __construct(PromoRepository $promoRepository)
    {
        $this->promoRepository = $promoRepository;
    }

    public function getAll(array $fields = ['*'])
    {
        return $this->promoRepository->getAll($fields);
    }

    public function getPromoWithRelationship(array $fields = ['*'], array $relationship)
    {
        return $this->promoRepository->getPromoWithRelationship($fields, $relationship);
    }

    public function getPromoByStatus(array $fields = ['*'], bool $is_active = true)
    {
        return $this->promoRepository->getPromoByStatus($fields, $is_active);
    }

    public function findById(int $id, array $fields = ['*'])
    {
        return $this->promoRepository->findById($id, $fields);
    }

    public function findByUuid(string $uuid, array $fields = ['*'])
    {
        return $this->promoRepository->findByUuid($uuid, $fields);
    }

    public function create(array $data)
    {
        if (isset($data['banner']) && $data['banner'] instanceof UploadedFile) {
            $data['banner'] = $this->uploadImage($data['banner']);
        }
        return $this->promoRepository->create($data);
    }

    public function update(array $data, string $uuid)
    {

        $promo = $this->promoRepository->findByUuid($uuid, ['id', 'banner']);

        if (isset($data['banner']) && $data['banner'] instanceof UploadedFile) {
            if (!empty($promo->banner)) {
                $this->deleteImage($promo->banner);
            }
            $data['banner'] = $this->uploadImage($data['banner']);
        }
        return $this->promoRepository->update($data, $uuid);
    }

    public function delete(string $uuid)
    {
        return $this->promoRepository->delete($uuid);
    }

    public function uploadImage(UploadedFile $file)
    {
        $path = $file->store('promo_images', 'public');
        return $path;
    }

    public function deleteImage(string $imagePath)
    {
        $relativePath = 'promo_images/' . basename($imagePath);
        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }
    }
}
