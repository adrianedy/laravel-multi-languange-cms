<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisionMissionRequest extends FormRequest
{
    public function __construct()
    {
        $this->errorBag = 'vision_mission';
        $this->redirect = url()->previous() . '#vision-mission';
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
            'image'     => 'image|max:128000',
            'en.vision' => 'required|max:500',
            'id.vision' => 'required|max:500',
            'en.mission'=> 'required|max:500',
            'id.mission'=> 'required|max:500',
        ];
    }

    public function attributes()
    {
        return [
            'en.vision' => 'english vision',
            'id.vision' => 'indonesia vision',
            'en.mission'=> 'english mission',
            'id.mission'=> 'indonesia mission',
        ];
    }
}
