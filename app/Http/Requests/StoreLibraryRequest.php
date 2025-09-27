<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLibraryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'platform' => [
                'required',
                'numeric',
                Rule::unique('libraries', 'platform_id')
                    ->where('game_id', request()->game->id)
                    ->where('user_id', auth()->user()->id)
            ],
            'playStatus' => 'required|numeric',
            'score' => 'nullable|numeric|between:0,10',
            'hours' => 'nullable|numeric|min:0',
            'hours_optional' => 'nullable|numeric|min:0',
            'hours_complete' => 'nullable|numeric|min:0',
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
            'playStatus' => 'play status',
            'hours' => 'main',
            'hours_optional' => 'optional',
            'hours_complete' => 'completionist',
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
            'platform.unique' => 'An entry already exists for this platform.',
            'platform.numeric' => 'The :attribute field is required.',
        ];
    }
}
