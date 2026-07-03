<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'transfer_bank_name' => ['required', 'string', 'max:100'],
            'account_holder_name' => ['required', 'string', 'max:150'],
            'proof_file' => ['required', 'file', 'mimes:jpg,jpeg,png,wepb', 'max:20480'],
        ];
    }
}
