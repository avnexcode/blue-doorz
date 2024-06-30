<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
            "name" => ["required", "min:5", "max:100", "unique:categories,name"]
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Nama kategori wajib diisi.",
            "name.min" => "Nama kategori harus memiliki setidaknya 5 karakter.",
            "name.max" => "Nama kategori tidak boleh lebih dari 100 karakter.",
            "name.unique" => "Nama kategori sudah tersedia.",
        ];
    }
}
