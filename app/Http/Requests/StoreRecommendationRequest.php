<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRecommendationRequest extends FormRequest
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
            'played' => 'required|numeric',
            'game' => [
                'required',
                'numeric'
,               'different:played',
                Rule::unique('recommendations', 'game_id')
                    ->where('played_game_id', request()->played)
                    ->where('user_id', auth()->user()->id)
            ],
            'platform' => 'required|numeric',
            'body' => 'required|min:500'
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
            'played' => 'game',
            'body' => 'recommendation'
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
            'game.different' => 'The games must be different.',
            'game.unique' => 'A recommendation already exists for this game.',
            'platform.numeric' => 'The :attribute field is required.'
        ];
    }
}
