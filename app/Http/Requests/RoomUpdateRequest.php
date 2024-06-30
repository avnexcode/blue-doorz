<?php

namespace App\Http\Requests;

use App\Models\Room;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RoomUpdateRequest extends FormRequest
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
            'category_id' => ['min:1', 'integer'],
            'name' => ['required', 'max:100'],
            'room_number' => [
                'required',
                'min:3',
                'integer',
                Rule::unique(Room::class)->ignore($this->room->id),
            ],
            'image' => ['file', 'mimes:jpeg,png,jpg', 'max:10240'],
            'description' => ['required', 'max:10000', 'min:100'],
            'price' => ['required', 'integer'],
            'status' => ['required'],

        ];
    }

    public function messages()
    {
        return [
            "category_id.integer" => "Kategori harus berupa angka.",
            "category_id.min" => "Kategori minimal harus 1.",

            "name.required" => "Nama tidak boleh kosong.",
            "name.max" => "Nama maksimal 100 karakter.",

            "room_number.required" => "Nomor ruangan tidak boleh kosong.",
            "room_number.min" => "Nomor ruangan minimal 3 karakter.",
            "room_number.integer" => "Nomor ruangan harus berupa angka.",
            "room_number.unique" => "Nomor ruangan sudah digunakan. Harap masukkan nomor lain.",

            "image.file" => "Gambar harus berupa file.",
            "image.mimes" => "Gambar harus memiliki format jpeg, png, atau jpg.",
            "image.max" => "Ukuran gambar maksimal 10MB.",

            "description.required" => "Deskripsi tidak boleh kosong.",
            "description.max" => "Deskripsi maksimal 10000s karakter.",
            "description.min" => "Deskripsi minimal 100 karakter.",

            "price.required" => "Harga tidak boleh kosong.",
            "price.integer" => "Harga harus berupa angka.",

            "status.required" => "Status tidak boleh kosong.",
        ];
    }
}
