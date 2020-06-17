<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            $data["{$translation->locale}[title]"]       = $translation->title;
            $data["{$translation->locale}[description]"] = $translation->description;
        }

        return $data;
    }
}
