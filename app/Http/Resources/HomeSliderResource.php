<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HomeSliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data =  [
            'image_url'  => $this->image_url,
        ];

        foreach ($this->translations as $translation) {
            $data["{$translation->locale}[title]"]          = $translation->title;
            $data["{$translation->locale}[button_label]"]   = $translation->button_label;
            $data["{$translation->locale}[button_url]"]     = $translation->button_url;
        }

        return $data;
    }
}
