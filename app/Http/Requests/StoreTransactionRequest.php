<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTransactionRequest extends FormRequest
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
            'kid' => 'required|numeric',
            'amount' => 'required|numeric|min:0.01',
            'type' => ['required', Rule::in(['DEPOSIT', 'WITHDRAWAL'])],
            'date' => 'required|date',
            'note' => 'nullable|string|max:255',
        ];
    }
}
