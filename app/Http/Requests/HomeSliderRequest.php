<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeSliderRequest extends FormRequest
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
            'image'             => 'required|image|max:128000',
            'en.title'          => 'required|max:50',
            'en.button_label'   => 'required|max:20',
            'en.button_url'     => 'required|max:100',
            'id.title'          => 'required|max:50',
            'id.button_label'   => 'required|max:20',
            'id.button_url'     => 'required|max:100',
        ];
        
        if (request()->isMethod('patch')) {
            $rules['image'] = 'image';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'en.title'          => 'english title',
            'en.button_label'   => 'english button label',
            'en.button_url'     => 'english button url',
            'id.title'          => 'indonesia title',
            'id.button_label'   => 'indonesia button label',
            'id.button_url'     => 'indonesia button url',
        ];
    }
}
