<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
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
            'name'          => 'required|max:50',
            'department'    => 'max:50',
            'location'      => 'max:50',
            'level'         => 'max:50',
            'deadline'      => 'date',
            'en.description'=> 'required|max:5000',
            'id.description'=> 'required|max:5000',
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
