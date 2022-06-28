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
            'schedules.*.working_day' => ['required', 'string'],
            'schedules.*.work_start' => ['required'],
            'schedules.*.work_end' => ['required']
        ];
    }
}
