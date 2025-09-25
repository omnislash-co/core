<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReplayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->id === $this->library->user_id;;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'hours' => 'required_without_all:hours_optional,hours_complete|nullable|numeric|min:0',
            'hours_optional' => 'required_without_all:hours,hours_complete|nullable|numeric|min:0',
            'hours_complete' => 'required_without_all:hours,hours_optional|nullable|numeric|min:0',
            'notes' => 'max:255'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'hours' => 'main',
            'hours_optional' => 'optional',
            'hours_complete' => 'completionist',
        ];
    }
}
