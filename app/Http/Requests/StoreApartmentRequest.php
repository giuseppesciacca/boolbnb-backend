<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApartmentRequest extends FormRequest
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
            //scrivere regole di validazione

            'user_id' => 'exists:users,id',
            'title' => 'required',
            'image' => 'nullable',
            'description' => 'nullable',
            'rooms' => 'required|numeric|min:1|max:120',
            'bathrooms' => 'required|numeric|min:1|max:120',
            'beds' => 'required|numeric|min:1|max:120',
            'square_meters' => 'required|numeric|min:10|max:120',
            'address' => 'required',
            'visibility' => 'nullable'
        ];
    }
}
