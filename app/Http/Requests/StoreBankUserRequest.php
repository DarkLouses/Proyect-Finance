<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBankUserRequest extends FormRequest
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
            'user_id' => Rule::unique('banks', 'id')->where('user_id', auth()->id()),
            'bank_id' => Rule::exists('banks', 'id')->where('user_id', auth()->id())
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.unique' => 'No puedes compartir Bancos contigo mismo',
            'bank_id.exists' => 'Este Banco ya esta compartido con el usuario'
        ];
    }
}
