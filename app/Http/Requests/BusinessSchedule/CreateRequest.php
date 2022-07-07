<?php

namespace App\Http\Requests\BusinessSchedule;

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
            'work_schedule' => ['required', 'string'],
            'work_start' => ['required'],
            'work_end' => ['required']
        ];
    }
}
