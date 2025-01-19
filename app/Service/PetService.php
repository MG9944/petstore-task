<?php

declare(strict_types=1);

namespace App\Service;

use App\Factory\PetFactory;
use App\Http\Request\Pet\ManageRequest;
use App\Repository\PetRepository;
use Illuminate\Http\Client\Response;


class PetService
{

    public function __construct
    (
        private readonly PetFactory $petFactory,
        private readonly PetRepository $petRepository,
    ){
    }

    public function get(?int $petId, ?string $status): Response
    {
        return $this->petRepository->get($petId, $status);
    }

    public function delete(int $petId): Response
    {

        if ($petId <= 0) {
            throw new \Exception('Pet ID must be a positive integer');
        }

        return $this->petRepository->delete($petId);
    }

    public function uploadImage(int $petId, string $name, string $content, string $filePath): Response
    {
        if ($petId <= 0) {
            throw new \Exception('Pet ID must be a positive integer');
        }

        return $this->petRepository->uploadImage($petId, $name, $content, $filePath);
    }

    public function create(ManageRequest $request): Response
    {
        $pet = $this->petFactory->create($request);
        return $this->petRepository->create($pet->toArray());
    }

    public function edit(ManageRequest $request): Response
    {
        $pet = $this->petFactory->create($request);
        return $this->petRepository->edit($pet->toArray());
    }
}
