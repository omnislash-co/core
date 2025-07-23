<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReviewRequest extends FormRequest
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
            'game' => 'required',
            'platform' => [
                'required',
                'numeric',
                // Rule::unique('reviews', 'platform_id')
                //     ->where('game_id', $this->gameId)
                //     ->where('user_id', auth()->user()->id)->ignore($this)
            ],
            'body' => 'required|min:500',
            'summary' => 'required|min:50|max:255',
            'score' => 'required|numeric|between:0,100'
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
            'body' => 'review',
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
            'platform.unique' => 'A review already exists for this platform.',
            'platform.numeric' => 'The :attribute field is required.',
        ];
    }
}
