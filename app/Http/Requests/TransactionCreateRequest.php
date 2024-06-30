<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionCreateRequest extends FormRequest
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
            "user_id" => ["required", "integer", "min:1"],
            "room_id" => ["required", "integer", "min:1"],
            "started_time" => ["required", "date", "unique:transactions,started_time,NULL,id,end_time,NULL"],
            "end_time" => ["required", "date", "after:started_time"],
            "price" => ["required"],
            "phone" => ["required", "digits_between:10,13"],
            "nik" => ["required", "digits:16"],
            "payment_method" => ["required", "in:cash,dana,credit"],
        ];
    }

    public function messages(): array
    {
        return [
            "user_id.required" => "ID pengguna wajib diisi.",
            "user_id.integer" => "ID pengguna harus berupa angka.",
            "user_id.min" => "ID pengguna harus minimal 1.",

            "room_id.required" => "ID kamar wajib diisi.",
            "room_id.integer" => "ID kamar harus berupa angka.",
            "room_id.min" => "ID kamar harus minimal 1.",

            "started_time.required" => "Waktu mulai sewa wajib diisi.",
            "started_time.date" => "Waktu mulai sewa harus berupa tanggal yang valid.",
            "started_time.unique" => "Waktu mulai sewa sudah terdaftar pada rentang waktu yang lain.",

            "end_time.required" => "Waktu berakhir sewa wajib diisi.",
            "end_time.date" => "Waktu berakhir sewa harus berupa tanggal yang valid.",
            "end_time.after" => "Waktu berakhir sewa harus lebih besar dari waktu mulai sewa.",

            "price.required" => "Harga sewa wajib diisi.",

            "phone.required" => "Nomor telepon wajib diisi.",
            "phone.digits_between" => "Nomor telepon harus terdiri dari 10 hingga 13 digit.",

            "nik.required" => "NIK wajib diisi.",
            "nik.digits" => "NIK harus terdiri dari 16 digit.",

            "payment_method.required" => "Metode pembayaran wajib diisi.",
            "payment_method.in" => "Metode pembayaran tidak valid. Silakan pilih salah satu dari: cash, dana, atau credit.",
        ];
    }
}
