<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categoryId = $this->route('category')?->id
            ?? $this->route('category');

        return [
            'name' => ['required', 'string', 'max:100', 'unique:categories,name,'.$categoryId],
            'icon_class' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:500'],
        ];
    }
}
