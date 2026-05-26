<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CharacterPassiveResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'level_required' => $this->level_required,
            'clase'          => new ClaseResource($this->whenLoaded('clase')),
            'passive'        => new PassiveResource($this->whenLoaded('passive')),
        ];
    }
}
