<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//Importazione Helpers:
use Illuminate\Validation\Rule;
class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => [
                'required', 
                Rule::unique('projects')->ignore($this->project->id),
                'max:255'
            ],
            'description'=> 'required|max:2000',
            'link'=> [
                'required',
                'max:255',
                'url',
                Rule::unique('projects')->ignore($this->project)
            ],
            'image'=> 'nullable|max:2048|image',
            'delete_img' => 'nullable',
            'type_id' => 'nullable|exists:types,id'
        ];
    }
}
