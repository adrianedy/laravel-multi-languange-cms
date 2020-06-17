<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfficeResource extends JsonResource
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
            'phone_number' => $this->phone_number,
            'location_picker' => [$this->latitude, $this->longitude],
        ];

        foreach ($this->translations as $translation) {
            $data["{$translation->locale}[name]"] = $translation->name;
            $data["{$translation->locale}[address]"] = $translation->address;
        }

        return $data;
    }
}
