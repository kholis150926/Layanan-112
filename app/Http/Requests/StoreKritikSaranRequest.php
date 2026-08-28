<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKritikSaranRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'pelapor' => ['required', 'string', 'max:255'],
            'kontak'  => ['required', 'string', 'max:255'],
            'pesan'   => ['required', 'string', 'max:2000'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'pelapor.required' => 'Nama pelapor wajib diisi.',
            'kontak.required'  => 'Kontak wajib diisi.',
            'pesan.required'   => 'Pesan tidak boleh kosong.',
            'pesan.max'        => 'Pesan maksimal 2000 karakter.',
        ];
    }
}