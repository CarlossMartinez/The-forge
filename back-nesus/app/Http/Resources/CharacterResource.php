<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CharacterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'description'  => $this->description,
            'level'        => $this->level,
            'experience'   => $this->experience,
            'hp_max'       => $this->hp_max,
            'hp_current'   => $this->hp_current,
            'hp_temp'      => $this->hp_temp,
            'alignment'    => $this->alignment,
            'image'        => $this->image,
            'manual_code'  => $this->manual_code,
            'user'         => new UserResource($this->whenLoaded('user')),
            'race'         => new RaceResource($this->whenLoaded('race')),
            'subrace'      => new SubraceResource($this->whenLoaded('subrace')),
            'background'   => new BackgroundResource($this->whenLoaded('background')),
            'clase'        => new ClaseResource($this->whenLoaded('clase')),
            'subclass'     => new SubclassResource($this->whenLoaded('subclass')),
            'stats'        => CharacterStatResource::collection($this->whenLoaded('stats')),
            'spells'       => SpellResource::collection($this->whenLoaded('spells')),
            'items'        => ItemResource::collection($this->whenLoaded('items')),
            'feats'        => FeatResource::collection($this->whenLoaded('feats')),
            'passives'     => PassiveResource::collection($this->whenLoaded('passives')),
            'proeficiencies' => ProeficiencyResource::collection($this->whenLoaded('proeficiencies')),
        ];
    }
}
