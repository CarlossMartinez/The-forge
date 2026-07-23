<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClaseProeficiencyRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'clase_id'         => 'required|integer|exists:clases,id',
            'proeficiencie_id' => 'required|integer|exists:proeficiencies,id',
        ];
    }
}
