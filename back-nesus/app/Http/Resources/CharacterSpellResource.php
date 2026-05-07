<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CharacterSpellResource extends JsonResource
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
            'is_prepared' => (bool) $this->is_prepared,
            'character'   => new CharacterResource($this->whenLoaded('character')),
            'spell'       => new SpellResource($this->whenLoaded('spell')),
        ];
    }
}
