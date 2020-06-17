<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AsSectionResource extends JsonResource
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
            $data["{$translation->locale}[name]"]          = $translation->name;
            $data["{$translation->locale}[description]"]   = $translation->description;
        }

        return $data;
    }
}
