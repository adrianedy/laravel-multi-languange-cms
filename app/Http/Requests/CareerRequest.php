<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CareerRequest extends FormRequest
{
    public function __construct()
    {
        $this->errorBag = 'first_section';
        $this->redirect = url()->previous() . '#first-section';
    }
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
            'image'          => 'image|max:128000',
            'en.description' => 'required|max:1000',
            'id.description' => 'required|max:1000',
        ];
    }

    public function attributes()
    {
        return [
            'en.description' => 'english description',
            'id.description' => 'indonesia description',
        ];
    }
}
