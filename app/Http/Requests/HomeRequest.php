<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Home;

class HomeRequest extends FormRequest
{
    public function __construct()
    {
        $this->errorBag = 'first_section';
        $this->redirect = url()->previous();
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
        $rules = [
            'image'         => 'required|image|max:128000',
            'en.title'      => 'required|max:50',
            'en.description'=> 'required|max:500',
            'en.url'        => 'required|max:100',
            'id.title'      => 'required|max:50',
            'id.description'=> 'required|max:500',
            'id.url'        => 'required|max:100',
        ];
        
        $home = Home::first();

        if ($home && $home->image) {
            $rules['image'] = 'image';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'en.title'      => 'english title',
            'en.description'=> 'english description',
            'en.url'        => 'english learn more url',
            'id.title'      => 'indonesia title',
            'id.description'=> 'indonesia description',
            'id.url'        => 'indonesia learn more url',
        ];
    }
}
