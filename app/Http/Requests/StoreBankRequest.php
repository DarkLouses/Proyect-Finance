<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBankRequest extends FormRequest
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
            'name' => 'required',
            'account_number' => 'required|numeric',
            'account_type' => 'required',
            'balance' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la cuenta es requerido',
            'account_number.required' => 'El numero de cuenta es requerido',
            'account_type.required' => 'El tipo de cuenta es requerido',
            'balance.required' => 'El monto es requerido'

    }
}
