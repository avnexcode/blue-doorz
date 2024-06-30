<?php

namespace App\Http\Requests;

use App\Rules\RealEmailRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use App\Models\User;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:' . User::class],
            'password' => ['required', 'confirmed', 'min:8', 'max:255', Rules\Password::defaults()],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi dan tidak boleh kosong.',
            'name.string' => 'Nama harus berupa string.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'email.required' => 'Email wajib diisi dan tidak boleh kosong.',
            'email.string' => 'Email harus berupa string.',
            'email.lowercase' => 'Email harus menggunakan huruf kecil.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'email.unique' => 'Email ini sudah digunakan. Silakan gunakan alamat email yang berbeda.',

            'password.required' => 'Kata sandi wajib diisi dan tidak boleh kosong.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'password.min' => 'Kata sandi harus memiliki minimal 8 karakter.',
            'password.max' => 'Kata sandi tidak boleh lebih dari 255 karakter.',
        ];
    }
}
