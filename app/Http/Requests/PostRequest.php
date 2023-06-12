<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'text' => ['nullable'],
            //'status' => ['required', 'integer'],
            //'published_at' => ['required', 'date'],
        ];
    }
}
