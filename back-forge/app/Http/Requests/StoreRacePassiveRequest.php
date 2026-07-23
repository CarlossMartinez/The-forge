<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRacePassiveRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'race_id'    => 'required|integer|exists:races,id',
            'passive_id' => 'required|integer|exists:passives,id',
        ];
    }
}
