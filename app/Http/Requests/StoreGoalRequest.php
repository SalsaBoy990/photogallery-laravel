<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGoalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            [
                'title' => ['required', 'unique:goals', 'min:20', 'max:255'],
                'description' => ['required', 'min:20', 'max:512'],
                'completed' => ['required', 'boolean'],
            ]
        ];
    }
}
