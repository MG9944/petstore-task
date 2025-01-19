<?php

declare(strict_types=1);

namespace App\Models;

class Pet
{
    private int $id;
    private string $name;
    private ?PetCategory $category;
    private array $photoUrls;
    private ?array $tags;
    private ?string $status;

    public function __construct(
        int $id = 0,
        string $name = '',
        PetCategory $category = null,
        array $photoUrls = [],
        array $tags = [],
        string $status = ''
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->photoUrls = $photoUrls;
        $this->tags = $tags;
        $this->status = $status;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'category' => $this->getCategory(),
            'photoUrls' => $this->getPhotoUrls(),
            'tags' => $this->getTags(),
            'status' => $this->getStatus(),
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCategory(): ?PetCategory
    {
        return $this->category;
    }

    public function setCategory(PetCategory $category): void
    {
        $this->category = $category;
    }

    public function getPhotoUrls(): array
    {
        return $this->photoUrls;
    }

    public function setPhotoUrls(array $photoUrls): void
    {
        $this->photoUrls = $photoUrls;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}
