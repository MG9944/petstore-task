<?php

declare(strict_types=1);

namespace App\Http\Request\Pet;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ManageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function passedValidation(): void
    {
        $this->merge([
            'manageId' => (int) $this->input('manageId'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'manageId' => 'required|digits_between:1,19',
            'manageName' => 'required|string',
            'manageCategory' => 'nullable|string',
            'managePhotoUrls' => 'required',
            'managePhotoUrls.*' => 'string',
            'manageTags' => 'nullable',
            'manageTags.*' => 'string',
            'manageStatus' => ['nullable', Rule::in(config('petStatus'))],
        ];
    }
}
