<?php

namespace App\Http\Requests\Admin\successStories;

use App\Http\Requests\BaseRequest\BaseRequest;

class successStoriesUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => 'sometimes|required|string',
            'title' => 'sometimes|required|string|max:255',
            'info' => 'sometimes|required|string|max:255',
        ];
    }
}
