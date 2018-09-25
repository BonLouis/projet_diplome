<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\ImageUrl;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|min:2',
            'description' => 'required|string|min:10',
            'type' => ['required', Rule::in(['formation', 'stage'])],
            'price' => 'required|numeric|between:0.00,99999.99',
            'max_seats' => 'required|integer|between:1,65536', // nb: unsigned smallint
            'begin_at' => 'required|date',
            'end_at' => 'required|date|after:begin_at',
            'status' => ['required', Rule::in(['draft', 'published', 'trash'])],
            'open' => 'required|boolean',
            'picture_url' => ['required', 'url', new ImageUrl],
            'categories' => 'required' 
        ];
    }
    public function messages() {
        return [
            'title.required' => 'Ce champ est requis.',
            'title.min' => 'Le titre doit faire au minimum 2 caractères.',
            'description.required' => 'Ce champ est requis.',
            'description.min' => 'La description doit faire au minimum 10 caractères',
            'type.required' => 'Ce champ est requis.',
            'price.required' => 'Ce champ est requis.',
            'price.numeric' => 'Le prix doit être un entier.',
            'price.between' => 'Le prix doit être compris entre 0 et 99999,99.',
            'max_seats.required' => 'Ce champ est requis.',
            'max_seats.integer' => 'Le nombre de place doit être un entier.',
            'max_seats.between' => 'Le nombre de place doit être compris entre 1 et 65536.',
            'begin_at.required' => 'Ce champ est requis.',
            'end_at.required' => 'Ce champ est requis.',
            'end_at.after' => 'La date de fin doit être postérieur à la date de début.',
            'status.required' => 'Ce champ est requis.',
            'open.required' => 'Ce champ est requis.',
            'picture_url.required' => 'Ce champ est requis.',
            'picture_url.url' => "L'url doit être une url valide.",
            'categories.required' => 'Ce champ est requis.',
        ];
    }
}
