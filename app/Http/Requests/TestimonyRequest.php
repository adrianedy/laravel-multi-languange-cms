<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonyRequest extends FormRequest
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
            'image'         => 'required|image|max:128000',
            'name'          => 'required|max:50',
            'profession'    => 'required|max:50',
            'en.testimony'  => 'required|max:1000',
            'id.testimony'  => 'required|max:1000',
        ];
        
        if (request()->isMethod('patch')) {
            $rules['image'] = 'image';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'en.testimony'  => 'english testimony',
            'id.testimony'  => 'indonesia testimony',
        ];
    }
}
