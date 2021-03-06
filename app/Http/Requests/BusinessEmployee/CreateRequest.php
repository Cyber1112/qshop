<?php

namespace App\Http\Requests\BusinessEmployee;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'phone_number' => ['required', 'string'],
            'name' => ['required', 'string'],
            'position' => ['required', 'string'],
            'password' => ['required'],
            'permissions' => ['required']
        ];
    }
}
