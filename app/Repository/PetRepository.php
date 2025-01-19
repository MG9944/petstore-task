<?php

namespace App\Repository;

use App\Http\HttpClient\HttpClientInterface;
use App\Service\UrlBuildService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;


class PetRepository
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly UrlBuildService $urlBuildService
    ){
    }
    public function get(?int $petId, ?string $petStatus): Response
    {
        return $this->httpClient->get($this->urlBuildService->SearchUrl($petId, $petStatus));
    }

    public function delete(int $petId): Response
    {
        return $this->httpClient->delete($this->urlBuildService->deleteUrl($petId));
    }

    /**
     * @throws ConnectionException
     */
    public function uploadImage(int $petId, string $name, string $content, string $filePath): Response
    {
        return $this->httpClient->attach($name, $content, $filePath)
            ->post($this->urlBuildService->UploadImageUrl($petId));
    }

    public function create(array $data): Response
    {
        return $this->httpClient->post($this->urlBuildService->petStoreApi(), $data);
    }

    public function edit(array $data): Response
    {
        return $this->httpClient->put($this->urlBuildService->petStoreApi(), $data);
    }
}
