<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLibraryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->id === $this->library->user_id;
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
                    ->where('game_id', $this->library->game->id)
                    ->where('user_id', auth()->user()->id)->ignore($this->library)
            ],
            'playStatus' => 'required|numeric',
            'score' => 'nullable|numeric|between:0,10',
            'hours' => 'nullable|numeric|min:0',
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
