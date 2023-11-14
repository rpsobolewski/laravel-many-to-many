<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::id() === 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|unique:projects|bail|min:3|max:200',
            'thumb' => 'nullable|image|max:300',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|exists:technologies,id',
            'description' => 'nullable|bail|min:3|max:500',
            'link_github' => ['nullable', 'bail', 'min:3', 'max:2048'],
            'link_project' => ['nullable', 'bail', 'min:3', 'max:2048'],
        ];
    }
}
