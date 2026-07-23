<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpellResource extends JsonResource
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
            'school'       => $this->school,
            'casting_time' => $this->casting_time,
            'duration'     => $this->duration,
            'range'        => $this->range,
            'components'   => $this->components,
            'manual_code'  => $this->manual_code,
            // Esto sirve para saber si esta preparado esperando a que la tabla pivot tenga el campo is_prepared 
            'is_prepared'  => $this->whenPivotLoaded('character_spell', fn() => (bool) $this->pivot->is_prepared), 
        ]; 
    }
}
