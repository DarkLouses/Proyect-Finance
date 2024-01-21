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
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'require',
            'account_number' => 'required|numeric',
            'account_type' => 'required',
            'balance' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.require' => 'El nombre de la cuenta es requerido',
            'account_number.require' => 'El numero de cuenta es requerido',
            'account_type.require' => 'El tipo de cuenta es requerido',
            'balance.require' => 'El monto es requerido'
        ];
    }
}
