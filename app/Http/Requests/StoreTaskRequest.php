<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class StoreTaskRequest extends FormRequest
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
            'title' => 'required|max:125',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Waduh, Judul Tugas Hari ini jangan dikosongin dong !',
            'title.max' => 'Tugas Hari lebih dari 125 huruf ya',
        ];
    }
}
