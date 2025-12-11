<?php

namespace App\Http\Requests\Admin\Packages;
use App\Http\Requests\BaseRequest\BaseRequest;
class PackagesStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'duration_days' => 'required|integer',
            'assignable_id' => 'nullable|integer',
            'assign_type' => 'required|string|max:255',
        ];
    }
}
