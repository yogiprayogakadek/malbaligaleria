<?php

namespace App\Services;

use App\Repositories\PromoRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImageOptimizer;

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

    public function getAllWithRelationship(array $fields = ['*'], array $relationship)
    {
        return $this->promoRepository->getAllWithRelationship($fields, $relationship);
    }

    public function getPromoWithRelationship(array $fields = ['*'], array $relationship)
    {
        return $this->promoRepository->getPromoWithRelationship($fields, $relationship);
    }

    public function getPromoWithRelationshipAndCondition(array $fields = ['*'], array $relationship, string $column, string $condition)
    {
        return $this->promoRepository->getPromoWithRelationshipAndCondition($fields, $relationship, $column, $condition);
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
        if (isset($data['banner'])) {
            $uploadedBanners = [];
            if (is_array($data['banner'])) {
                foreach ($data['banner'] as $file) {
                    if ($file instanceof UploadedFile) {
                        $uploadedBanners[] = $this->uploadImage($file);
                    }
                }
            } elseif ($data['banner'] instanceof UploadedFile) {
                $uploadedBanners[] = $this->uploadImage($data['banner']);
            }
            $data['banner'] = json_encode($uploadedBanners);
        }
        return $this->promoRepository->create($data);
    }

    public function update(array $data, string $uuid)
    {
        $promo = $this->promoRepository->findByUuid($uuid, ['id', 'banner']);
        $existingBanners = $promo->banners;

        if (isset($data['retained_banners']) && is_array($data['retained_banners'])) {
            foreach ($existingBanners as $old) {
                if (!in_array($old, $data['retained_banners'])) {
                    $this->deleteImage($old);
                }
            }
            $finalBanners = array_values($data['retained_banners']);
        } else if (isset($data['banner']) && !empty($data['banner'])) {
            foreach ($existingBanners as $old) {
                $this->deleteImage($old);
            }
            $finalBanners = [];
        } else {
            $finalBanners = $existingBanners;
        }

        if (isset($data['banner']) && !empty($data['banner'])) {
            if (is_array($data['banner'])) {
                foreach ($data['banner'] as $file) {
                    if ($file instanceof UploadedFile) {
                        $finalBanners[] = $this->uploadImage($file);
                    }
                }
            } elseif ($data['banner'] instanceof UploadedFile) {
                $finalBanners[] = $this->uploadImage($data['banner']);
            }
        }

        unset($data['retained_banners']);
        $data['banner'] = json_encode(array_values($finalBanners));
        return $this->promoRepository->update($data, $uuid);
    }

    public function delete(string $uuid)
    {
        return $this->promoRepository->delete($uuid);
    }

    public function uploadImage(UploadedFile $file)
    {
        $path = $file->store('promo_images', 'public');
        ImageOptimizer::optimize($path);
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
