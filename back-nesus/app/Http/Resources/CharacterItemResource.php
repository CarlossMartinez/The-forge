<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CharacterItemResource extends JsonResource
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
            'quantity'    => $this->quantity,
            'is_equipped' => (bool) $this->is_equipped,
            'is_attuned'  => (bool) $this->is_attuned,
            'character'   => new CharacterResource($this->whenLoaded('character')),
            'item'        => new ItemResource($this->whenLoaded('item')),
        ];
    }
}
