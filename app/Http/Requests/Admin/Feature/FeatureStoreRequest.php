<?php

namespace App\Http\Requests\Admin\Feature;

use App\Http\Requests\BaseRequest\BaseRequest;

class FeatureStoreRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'key' => 'required|string|max:255|unique:features,key',
            'type' => 'required|in:boolean,number,text',
        ];
    }

    public function messages(): array
    {
        return [
            'key.required' => 'The feature key is required.',
            'key.string' => 'The feature key must be a string.',
            'key.max' => 'The feature key must not exceed 255 characters.',
            'key.unique' => 'The feature key has already been taken.',

            'type.required' => 'The feature type is required.',
            'type.in' => 'The feature type must be one of the following: boolean, number, text.',
        ];
    }
}
