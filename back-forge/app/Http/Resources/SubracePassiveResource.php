<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubracePassiveResource extends JsonResource
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
            'subrace'        => new SubraceResource($this->whenLoaded('subrace')),
            'passive'        => new PassiveResource($this->whenLoaded('passive')),
        ];
    }
}
