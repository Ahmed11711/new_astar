<?php

namespace App\Http\Requests\Admin\SocialMedia;
use App\Http\Requests\BaseRequest\BaseRequest;
class SocialMediaUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'link' => 'sometimes|required|string',
        ];
    }
}
