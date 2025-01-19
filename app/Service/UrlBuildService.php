<?php

namespace App\Service;


class UrlBuildService
{
    protected string $petStoreApi;
    private const SLASH = '/';
    private const FIND_BY_STATUS_URL = '/findByStatus?status=';
    private const UPLOAD_IMAGE_URL = '/uploadImage';

    public function __construct()
    {
        $this->petStoreApi = config('services.petstore.base_url');
    }

    public function SearchUrl(?int $petId, ?string $status): string
    {
        $url = '';
        if ($petId) {
            $url = sprintf('%s%s%d', $this->petStoreApi,self::SLASH, $petId);
        }

        elseif ($status) {
            $url = sprintf('%s%s%s', $this->petStoreApi,self::FIND_BY_STATUS_URL, $status);
        }

        return $url;
    }

    public function uploadImageUrl(int $petId): string {

        return sprintf('%s%s%d%s%s', $this->petStoreApi, self::SLASH, $petId, self::SLASH, self::UPLOAD_IMAGE_URL);
    }

    public function deleteUrl(int $petId): string {

        return sprintf('%s%s%d', $this->petStoreApi,self::SLASH, $petId);
    }

    public function petStoreApi(): string {

        return $this->petStoreApi;
    }
}
