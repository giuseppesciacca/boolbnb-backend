<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApartmentRequest extends FormRequest
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
            'rooms' => 'required',
            'bathrooms' => 'required',
            'beds' => 'required',
            'square_meters' => 'required',
            'address' => 'required',
            'visibility' => 'nullable'
        ];
    }
}
