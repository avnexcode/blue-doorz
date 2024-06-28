<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomCreateRequest extends FormRequest
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
            'category_id' => ['required', 'min:1'],
            'name' => ['required', 'max:100'],
            'room_number' => ['required', 'min:3'],
            'image' => ['required', 'file', 'mimes:jpeg,png,jpg', 'max:10240'],
            'description' => ['required', 'max:255', 'min:100'],
            'price' => ['required'],
            'status' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            "category_id.required" => "Kategori tidak boleh kosong.",
            "category_id.min" => "Kategori minimal harus 1.",

            "name.required" => "Nama tidak boleh kosong.",
            "name.max" => "Nama maksimal 100 karakter.",

            "room_number.required" => "Nomor ruangan tidak boleh kosong.",
            "room_number.min" => "Nomor ruangan minimal 3 karakter.",

            "image.required" => "Gambar tidak boleh kosong.",
            "image.file" => "Gambar harus berupa file.",
            "image.mimes" => "Gambar harus memiliki format jpeg, png, atau jpg.",
            "image.max" => "Ukuran gambar maksimal 10MB.",

            "description.required" => "Deskripsi tidak boleh kosong.",
            "description.max" => "Deskripsi maksimal 255 karakter.",
            "description.min" => "Deskripsi minimal 100 karakter.",

            "price.required" => "Harga tidak boleh kosong.",

            "status.required" => "Status tidak boleh kosong.",
        ];
    }
}
