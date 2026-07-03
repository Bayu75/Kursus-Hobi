<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:200'],
            'file' => ['required', 'file', 'mimes:mp4,mov,avi,mkv,wmv,webm,pdf,ppt,pptx,doc,docx', 'max:102400'],
            'sequence_order' => ['required', 'integer', 'min:1'],
        ];
    }
}
