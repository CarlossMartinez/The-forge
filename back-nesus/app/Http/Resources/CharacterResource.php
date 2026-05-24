<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Subclass;

class CharacterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Resolver nombre de subraza y subclase (incluye buscar subclase desde el pivot de clases)
        $subraceName = $this->subrace ? $this->subrace->name : null;

        $subclassName = null;
        if ($this->relationLoaded('subclass') && $this->subclass) {
            $subclassName = $this->subclass->name;
        } elseif ($this->relationLoaded('clases') && $this->clases->isNotEmpty()) {
            foreach ($this->clases as $clase) {
                $pivotSubclassId = $clase->pivot->subclass_id ?? null;
                if ($pivotSubclassId) {
                    if ($clase->relationLoaded('subclass')) {
                        $found = $clase->subclass->firstWhere('id', $pivotSubclassId);
                        if ($found) { $subclassName = $found->name; break; }
                    } else {
                        $found = Subclass::find($pivotSubclassId);
                        if ($found) { $subclassName = $found->name; break; }
                    }
                }
            }
        }

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
            'subrace_name' => $subraceName,
            'user'         => new UserResource($this->whenLoaded('user')),
            'race'         => new RaceResource($this->whenLoaded('race')),
            'subrace'      => new SubraceResource($this->whenLoaded('subrace')),
            'subclass_name'=> $subclassName,
            'background'   => new BackgroundResource($this->whenLoaded('background')),
            'clases'       => ClaseResource::collection($this->whenLoaded('clases')),
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
