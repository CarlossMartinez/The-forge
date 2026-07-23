<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'type'        => $this->type,
            'rarity'      => $this->rarity,
            'weight'      => $this->weight,
            'value'       => $this->value,
            'manual_code' => $this->manual_code,
            // Igual que en spell es para lo mismo
            'quantity'    => $this->whenPivotLoaded('character_item', fn() => $this->pivot->quantity),
            'is_equipped' => $this->whenPivotLoaded('character_item', fn() => (bool) $this->pivot->is_equipped),
            'is_attuned'  => $this->whenPivotLoaded('character_item', fn() => (bool) $this->pivot->is_attuned),
        ];    }
}
