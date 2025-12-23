<?php

namespace App\Http\Requests\Admin\SocialMedia;
use App\Http\Requests\BaseRequest\BaseRequest;
class SocialMediaStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'link' => 'required|string',
        ];
    }
}
