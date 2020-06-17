<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PositionResource extends JsonResource
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
            'name'      => $this->name,
            'department'=> $this->department,
            'location'  => $this->location,
            'level'     => $this->level,
            'deadline'  => date('m/d/Y', strtotime($this->deadline)),
        ];

        foreach ($this->translations as $translation) {
            $data["{$translation->locale}[description]"] = $translation->description;
        }

        return $data;
    }
}
