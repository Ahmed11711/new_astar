<?php

namespace App\Http\Requests\Admin\Packages;
use App\Http\Requests\BaseRequest\BaseRequest;
class PackagesUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|sometimes|string',
            'price' => 'sometimes|required|numeric',
            'duration_days' => 'sometimes|required|integer',
            'assignable_id' => 'nullable|sometimes|integer',
            'assign_type' => 'sometimes|required|string|max:255',
        ];
    }
}
