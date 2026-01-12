<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'min:3'],
            'phone' => ['required', 'string', 'min:7'],
            'status' => ['required', 'in:new,in_progress,done'],
            'note' => ['nullable', 'string'],
        ];
    }
}
