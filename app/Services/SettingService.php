<?php

namespace app\Services;

use App\Repositories\SettingRepository;

class SettingService
{
    protected $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function getAll(array $fields = ['*'])
    {
        return $this->settingRepository->getAll($fields);
    }

    public function getById(int $id, array $fields = ['*'])
    {
        return $this->settingRepository->getById($id, $fields);
    }

    public function getByPage(string $page, array $fields = ['*'])
    {
        return $this->settingRepository->getByPage($page, $fields);
    }

    public function create(array $data)
    {
        return $this->settingRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->settingRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->settingRepository->delete($id);
    }

    public function availablePages()
    {
        return [
            'home' => [
                'site_title' => 'text',
                'hero_background' => 'file',
                'hero_title' => 'text',
                'hero_subtitle' => 'text',
            ],
            'mal directory' => [
                'site_title' => 'text',
                'page_title' => 'text',
                'page_subtitle' => 'text'
            ],
            'event' => [
                'site_title' => 'text',
                'page_title' => 'text',
                'page_subtitle' => 'text'
            ],
            'promo' => [
                'site_title' => 'text',
                'page_title' => 'text',
                'page_subtitle' => 'text'
            ],
            'gallery' => [
                'site_title' => 'text',
                'page_title' => 'text',
                'page_subtitle' => 'text',
                'grid_columns' => 'number',
                'initial_images' => 'number',
                'load_more_increment' => 'number',
                'enable_zoom' => 'select',
                'enable_download' => 'select',
                'enable_share' => 'select',
            ],
            'others' => [
                'company_address' => 'text',
                'contact_email' => 'email',
                'contact_phone' => 'telp',
                'social_facebook' => 'text',
                'social_instagram' => 'text',
                'logo' => 'file',
                'announcement_active' => 'select',
                'announcement_text' => 'text',
                'announcement_type' => 'select',
                'maintenance_mode' => 'select',
                'maintenance_message' => 'text',
            ],
            'mail' => [
                'mail_mailer' => 'text',
                'mail_host' => 'text',
                'mail_port' => 'number',
                'mail_username' => 'text',
                'mail_password' => 'text',
                'mail_encryption' => 'text',
                'mail_from_address' => 'email',
                'mail_from_name' => 'text',
                'hr_notification_email' => 'email',
            ]
        ];
    }
}
