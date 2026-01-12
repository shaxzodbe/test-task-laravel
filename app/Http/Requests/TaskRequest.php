<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3'],
            'due_at' => ['nullable', 'date'],
            'is_done' => ['boolean'],
        ];
    }
}
