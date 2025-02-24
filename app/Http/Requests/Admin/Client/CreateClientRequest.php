<?php

namespace App\Http\Requests\Admin\Client;

use Illuminate\Foundation\Http\FormRequest;

class CreateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'requeired',
            'cpf' => 'requeired',
            'email' => 'requeired',
            'phone' => 'requeired',
            'function' => 'requeired',
            'domain' => 'requeired',
            'password' => 'requeired',
        ];
    }
}
