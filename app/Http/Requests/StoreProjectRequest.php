<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'title' => 'required|max:255|unique:projects,title', //unique:projects,title fa in modo che il titolo di ogni progetto sia unico, di conseguenza anche lo slug
            'description'=> 'required|max:2000',
            'link'=> 'required|max:255|url|unique:projects,link',
            'image'=> 'nullable|max:2048|image',
            'type_id' => 'nullable|exists:types,id'
        ];
    }
}
