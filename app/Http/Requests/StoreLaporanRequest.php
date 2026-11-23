<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLaporanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->isPelapor();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:150'],
            'fasilitas' => ['required', 'string', 'exists:fasilitas,nama'],
            'lokasi' => ['required', 'string', 'max:150'],
            'kategori' => ['required', 'string', 'exists:kategori,nama'],
            'deskripsi' => ['required', 'string'],
            'foto' => ['required', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:5120'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'judul.required' => 'Judul laporan wajib diisi.',
            'judul.max' => 'Judul laporan maksimal 150 karakter.',
            'fasilitas.required' => 'Fasilitas wajib dipilih.',
            'fasilitas.exists' => 'Fasilitas yang dipilih tidak valid.',
            'lokasi.required' => 'Lokasi wajib diisi.',
            'lokasi.max' => 'Lokasi maksimal 150 karakter.',
            'kategori.required' => 'Kategori kerusakan wajib dipilih.',
            'kategori.exists' => 'Kategori yang dipilih tidak valid.',
            'deskripsi.required' => 'Deskripsi kerusakan wajib diisi.',
            'foto.required' => 'Foto bukti kerusakan wajib diunggah.',
            'foto.image' => 'File bukti harus berupa gambar.',
            'foto.mimes' => 'Format foto harus berupa JPG atau PNG.',
            'foto.max' => 'Ukuran foto maksimal 5 MB.',
        ];
    }
}
