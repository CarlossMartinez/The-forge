<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubclassResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'manual_code' => $this->manual_code,
            'clase'       => new ClaseResource($this->whenLoaded('clase')),
            'passives'    => PassiveResource::collection($this->whenLoaded('passives')),
            'spells'      => SpellResource::collection($this->whenLoaded('spells')),
        ];

    }
}
