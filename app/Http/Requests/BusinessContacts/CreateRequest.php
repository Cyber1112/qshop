<?php

namespace App\Http\Requests\BusinessContacts;

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
            'address' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string'],
            'site_location' => ['required', 'string', 'max:255'],
        ];
    }
}
