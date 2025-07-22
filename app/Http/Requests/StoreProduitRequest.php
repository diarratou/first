<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'libelle' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0 | max:10000',
            'qt' => 'required|integer|min:1 | max:1000',
            'description' => 'nullable|string',
            'categorie_id' => 'required|exists:categories,id',
        ];
    }
}
