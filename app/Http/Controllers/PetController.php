<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Request\Pet\DeleteRequest;
use App\Http\Request\Pet\ManageRequest;
use App\Http\Request\Pet\SearchRequest;
use App\Http\Request\Pet\UploadImageRequest;
use App\Service\PetService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PetController extends Controller
{


    public function __construct(private readonly PetService $petService)
    {
    }

    public function index(): View
    {
        return view('index');
    }

    public function get(SearchRequest $request): RedirectResponse
    {
        try {

            $response = $this->petService->get
            (
                $request->input('searchId'),
                $request->input('searchStatus')
            );
            return $this->handleHttpResponse(
                $response,
                __('pet.found')
            );
        } catch (\Exception $e) {

            return redirect()->back()->with('error', __('An error occurred: :message', ['message' => $e->getMessage()]));
        }
    }

    public function delete(DeleteRequest $request): RedirectResponse
    {
        try {
            $response = $this->petService->delete((int)$request->get('deleteId'));
            return $this->handleHttpResponse($response, __('pet.deleteSuccess'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('An error occurred: :message', ['message' => $e->getMessage()]));
        }
    }

    public function uploadImage(UploadImageRequest $request): RedirectResponse
    {
        try {
            $file = $request->file('uploadImage');
            $response = $this->petService->uploadImage(
                $request->input('uploadId'),
                'file',
                $file->getContent(),
                $file->getClientOriginalName());


            return $this->handleHttpResponse($response, __('pet.uploadSuccess'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('An error occurred: :message', ['message' => $e->getMessage()]));
        }
    }


    public function create(ManageRequest $request): RedirectResponse
    {
        try {
            $response = $this->petService->create($request);

            return $this->handleHttpResponse(
                $response,
                __('pet.addSuccess', [
                    'id' => json_decode($response->body(), true)['id'] ?? '???',
                ])
            );
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('An error occurred: :message', ['message' => $e->getMessage()]));
        }
    }

    public function update(ManageRequest $request): RedirectResponse
    {
        try {
            $response = $this->petService->update($request);

            return $this->handleHttpResponse(
                $response,
                __('pet.editSuccess', [
                    'id' => json_decode($response->body(), true)['id'] ?? '???',
                ])
            );
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('An error occurred: :message', ['message' => $e->getMessage()]));
        }
    }
}
