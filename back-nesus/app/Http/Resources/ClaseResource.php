<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                   => $this->id,
            'name'                 => $this->name,
            'description'          => $this->description,
            'hit_die'              => $this->hit_die,
            'spellcaster'          => $this->spellcaster,
            'spellcasting_ability' => $this->spellcasting_ability,
            'manual_code'          => $this->manual_code,
            'subclasses'           => SubclassResource::collection($this->whenLoaded('subclass')),
            'passives'             => PassiveResource::collection($this->whenLoaded('passives')),
            'spells'               => SpellResource::collection($this->whenLoaded('spells')),
            'proeficiencies'       => ProeficiencyResource::collection($this->whenLoaded('proeficiencies')),
        ];
    }
}
