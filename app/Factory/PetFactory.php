<?php

namespace App\Factory;

use App\Http\Request\Pet\ManageRequest;
use App\Models\Pet;
use App\Models\PetCategory;
use App\Models\PetTag;
use Illuminate\Http\RedirectResponse;

class PetFactory
{
    public function create(ManageRequest $request): Pet
    {
        $pet = new Pet();
        $pet->setId($request->input('manageId'));
        $pet->setName($request->input('manageName'));
        $pet->setPhotoUrls(explode(PHP_EOL, $request->input('managePhotoUrls')));
        $pet->setStatus($request->input('manageStatus'));

        if ($request->input('manageCategory')) {
            $pet->setCategory(new PetCategory(1, $request->input('manageCategory')));
        }

        $tags = array_map(
            fn($tag) => new PetTag(1, $tag),
            explode(PHP_EOL, $request->input('manageTags') ?? '')
        );
        $pet->setTags($tags);
        return $pet;
    }
}
