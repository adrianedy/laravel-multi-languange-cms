<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfficeRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'en.name' => 'required|max:50',
            'en.address' => 'required|max:200',
            'id.name' => 'required|max:50',
            'id.address' => 'required|max:200',
            'phone_number' => 'max:20',
            'latitude' => 'required',
            'longitude' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'en.name'       => 'english name',
            'id.name'       => 'indonesia name',
            'en.address'    => 'english address',
            'id.address'    => 'indonesia address',
            'phone_number'  => 'phone number',
            'latitude'      => 'Map latitude',
            'longitude'     => 'Map longitude',
        ];
    }
}
