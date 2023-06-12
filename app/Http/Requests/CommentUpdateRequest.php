<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'text' => ['required', 'max:800'],
        ];
    }
}
