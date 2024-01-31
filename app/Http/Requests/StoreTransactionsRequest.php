<?php

namespace App\Http\Requests;

use App\Rules\NonNegativeAmount;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'description' => 'required',
            'amount' => ['required', 'numeric', new NonNegativeAmount],
            'date' => 'required',
            'bank_id' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'description.required' => 'La descripcion del monto es requerida',
            'amount.required' => 'El monto es requerido',
            'amount.numeric' => 'El monto tiene que ser un numero',
            'amount' => 'El monto no puede ser negativo'
        ];
    }
}
