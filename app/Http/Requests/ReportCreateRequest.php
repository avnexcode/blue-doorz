<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportCreateRequest extends FormRequest
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
            'transaction_ids' => ['required', 'array', 'min:1'],
            'transaction_ids.*' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'transaction_ids.required' => 'Kolom ID transaksi wajib diisi.',
            'transaction_ids.array' => 'ID transaksi harus berupa array.',
            'transaction_ids.min' => 'Setidaknya satu ID transaksi diperlukan.',
            'transaction_ids.*.required' => 'Setiap ID transaksi wajib diisi.',
            'transaction_ids.*.string' => 'Setiap ID transaksi harus berupa string.',
        ];
    }
}
