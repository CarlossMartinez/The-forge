<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ManualResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'manual_code' => $this->manual_code,
            'name'        => $this->name,
            'description' => $this->description,
            'system'      => $this->system,
            'manual_type' => $this->manual_type,
            'is_active'   => $this->is_active,
            'user_id'     => $this->user_id,
        ];
    }
}
