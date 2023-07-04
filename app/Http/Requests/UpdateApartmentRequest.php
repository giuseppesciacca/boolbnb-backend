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
            'image.*' => 'nullable|max:2048|mimes:jpg,jpeg,png,bmp',
            'description' => 'nullable',
            'rooms' => 'required|numeric|min:1|max:50',
            'bathrooms' => 'required|numeric|min:1|max:25',
            'beds' => 'required|numeric|min:1|max:25',
            'square_meters' => 'required|numeric|min:30|max:9999',
            'address' => 'required',
            'visibility' => 'nullable',
            'services' => 'exists:services,id'
        ];
    }
}
