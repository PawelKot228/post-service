<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'text' => ['required', 'max:800'],
            'comment_id' => ['sometimes', 'integer'],
        ];
    }
}
