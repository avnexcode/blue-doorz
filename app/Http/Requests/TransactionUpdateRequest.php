<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionUpdateRequest extends FormRequest
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
            "status" => ["required", "in:pending,ongoing,expired,canceled"],
            "room_id" => ["required"],
            "user_id" => ["required"],
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Status wajib diisi.',
            'status.in' => 'Status yang dipilih tidak valid. Pilihan yang tersedia adalah: pending, ongoing, expired, canceled.',

            'room_id.required' => 'ID ruangan harus diisi',
            'user_id.required' => 'ID user harus diisi',
        ];
    }
}
