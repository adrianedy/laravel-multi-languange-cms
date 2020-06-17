<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        foreach ($this->translations as $translation) {
            $data["{$translation->locale}[name]"]        = $translation->name;
            $data["{$translation->locale}[description]"] = $translation->description;
        }

        return $data;
    }
}
