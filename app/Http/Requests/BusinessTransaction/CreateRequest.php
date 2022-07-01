<?php

namespace App\Http\Requests\BusinessTransaction;

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
            'bonus_amount' => ['required', 'int'],
            'purchase_amount' => ['required', 'int'],
            'comment' => ['string']
        ];
    }
}
