<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApartmentSponsorRequest extends FormRequest
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
            'sponsor_id' => 'exists:sponsors,id',
            'apartment_id' => 'exists:apartaments,id',
            'start_date' => 'date',
            'expire_date' => 'date',
        ];
    }
}
