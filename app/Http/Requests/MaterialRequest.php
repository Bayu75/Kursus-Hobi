<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'file' => [
                'required',
                'mimes:mp4,pdf',
                'max:51200'
            ],
            'sequence_order' => ['required'],
        ];
    }
}
