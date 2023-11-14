<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
     * @return array<string, 
     */
    public function rules(): array
    {
        return [
            'type_id' => 'nullable|exists:types,id',
            'title' => ['required',  'min:3', Rule::unique('projects')->ignore($this->project), 'max:200'],
            'thumb' => ['nullable', 'image', 'max:300'],
            /*  'technologies' => 'nullable|exists:technologies,id', */
            'description' => ['nullable', 'bail', 'min:3', 'max:500'],
            'link_github' => ['nullable', 'bail', 'min:3', 'max:2048'],
            'link_project' => ['nullable', 'bail', 'min:3', 'max:2048'],

        ];
    }
}
