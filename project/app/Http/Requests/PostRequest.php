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
}
