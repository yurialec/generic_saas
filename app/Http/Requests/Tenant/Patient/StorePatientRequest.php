<?php

namespace App\Http\Requests\Tenant\Patient;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
            'group' => 'required|in:child,adult,teen,elderly',
            'gender' => 'required|in:F,M,other',
            'age' => 'required|integer|min:0',
            'full_name' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:patients,cpf',
            'email' => 'required|email|max:255|unique:patients,email',
            'phone' => 'required|string|max:20',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_phone' => 'nullable|string|max:20',
            'emergency_contact' => 'required|string|max:255',
            'emergency_phone' => 'required|string|max:20',
            'payment_plan' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'tenant_id' => 'nullable|integer|exists:tenants,id',
        ];
    }

    public function messages(): array
    {
        return [
            'group.required' => 'O campo grupo é obrigatório.',
            'group.in' => 'O grupo selecionado é inválido. Valores permitidos: child, adult, teen, elderly.',
            'gender.required' => 'O campo gênero é obrigatório.',
            'gender.in' => 'O gênero selecionado é inválido. Valores permitidos: F, M, other.',
            'age.required' => 'O campo idade é obrigatório.',
            'age.integer' => 'O campo idade deve ser um número inteiro.',
            'age.min' => 'O campo idade deve ser maior ou igual a 0.',
            'full_name.required' => 'O campo nome completo é obrigatório.',
            'full_name.string' => 'O campo nome completo deve ser uma cadeia de caracteres.',
            'full_name.max' => 'O campo nome completo não pode ter mais de 255 caracteres.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.string' => 'O campo CPF deve ser uma cadeia de caracteres.',
            'cpf.max' => 'O campo CPF não pode ter mais de 14 caracteres.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail deve ser um endereço de e-mail válido.',
            'email.max' => 'O campo e-mail não pode ter mais de 255 caracteres.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'phone.required' => 'O campo telefone é obrigatório.',
            'phone.string' => 'O campo telefone deve ser uma cadeia de caracteres.',
            'phone.max' => 'O campo telefone não pode ter mais de 20 caracteres.',
            'guardian_name.string' => 'O campo nome do responsável deve ser uma cadeia de caracteres.',
            'guardian_name.max' => 'O campo nome do responsável não pode ter mais de 255 caracteres.',
            'guardian_phone.string' => 'O campo telefone do responsável deve ser uma cadeia de caracteres.',
            'guardian_phone.max' => 'O campo telefone do responsável não pode ter mais de 20 caracteres.',
            'emergency_contact.required' => 'O campo contato de emergência é obrigatório.',
            'emergency_contact.string' => 'O campo contato de emergência deve ser uma cadeia de caracteres.',
            'emergency_contact.max' => 'O campo contato de emergência não pode ter mais de 255 caracteres.',
            'emergency_phone.required' => 'O campo telefone de emergência é obrigatório.',
            'emergency_phone.string' => 'O campo telefone de emergência deve ser uma cadeia de caracteres.',
            'emergency_phone.max' => 'O campo telefone de emergência não pode ter mais de 20 caracteres.',
            'payment_plan.string' => 'O campo plano de pagamento deve ser uma cadeia de caracteres.',
            'payment_plan.max' => 'O campo plano de pagamento não pode ter mais de 255 caracteres.',
            'notes.string' => 'O campo observações deve ser uma cadeia de caracteres.',
            'tenant_id.integer' => 'O campo tenant_id deve ser um número inteiro.',
            'tenant_id.exists' => 'O tenant_id informado não existe.',
        ];
    }
}
