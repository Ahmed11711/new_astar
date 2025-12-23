<?php

namespace App\Http\Requests\Admin\FeaturePackage;

use App\Http\Requests\BaseRequest\BaseRequest;
use Illuminate\Validation\Rule;

class FeaturePackageStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'package_id' => [
                'required',
                'integer',
                'exists:packages,id',
            ],
            'feature_id' => [
                'required',
                'integer',
                'exists:features,id',
                // Prevent duplicate combination
                Rule::unique('feature_packages')->where(function ($query) {
                    return $query->where('package_id', $this->package_id);
                }),
            ],
            'value' => 'required|string|max:255',
            'lable' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'package_id.required' => 'The package ID is required.',
            'package_id.integer' => 'The package ID must be an integer.',
            'package_id.exists' => 'The selected package does not exist.',

            'feature_id.required' => 'The feature ID is required.',
            'feature_id.integer' => 'The feature ID must be an integer.',
            'feature_id.exists' => 'The selected feature does not exist.',
            'feature_id.unique' => 'This feature is already assigned to the selected package.',

            'value.required' => 'The value is required.',
            'value.string' => 'The value must be a string.',
            'value.max' => 'The value must not exceed 255 characters.',
        ];
    }
}
