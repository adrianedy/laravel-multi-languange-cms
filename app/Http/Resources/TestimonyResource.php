<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TestimonyResource extends JsonResource
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
            'image_url' => $this->image_url,
            'name'      => $this->name,
            'profession'=> $this->profession,
        ];

        foreach ($this->translations as $translation) {
            $data["{$translation->locale}[testimony]"] = $translation->testimony;
        }

        return $data;
    }
}
