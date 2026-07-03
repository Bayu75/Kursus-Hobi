<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'location_name' => ['required', 'string', 'max:200'],
            'google_maps_link' => ['nullable', 'string', 'max:500'],
            'quota' => ['required', 'integer', 'min:1'],
        ];
    }
}
