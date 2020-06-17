<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AfterSalesSectionRequest extends FormRequest
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
        $rules = [
            'image' => 'required|image|max:128000',
            'en.name'  => 'required|max:50',
            'en.description'  => 'required|max:500',
            'id.name'  => 'required|max:50',
            'id.description'  => 'required|max:500',
        ];

        if (request()->isMethod('patch')) {
            $rules['image'] = 'image';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'en.name' => 'english name',
            'en.description' => 'english description',
            'id.name' => 'indonesia name',
            'id.description' => 'indonesia description',
        ];
    }
}
