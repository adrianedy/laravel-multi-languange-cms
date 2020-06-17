<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpecificationRequest extends FormRequest
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
            'en.name'   => 'required|max:50',
            'id.name'   => 'required|max:50',
            'en.detail' => 'required|max:100',
            'id.detail' => 'required|max:100',
        ];
    }

    public function attributes()
    {
        return [
            'en.name'   => 'english name',
            'id.name'   => 'indonesia name',
            'en.detail' => 'english detail',
            'id.detail' => 'indonesia detail',
        ];
    }
}
