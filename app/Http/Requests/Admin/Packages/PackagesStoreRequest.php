<?php

namespace App\Http\Requests\Admin\Packages;

use App\Http\Requests\BaseRequest\BaseRequest;
use Illuminate\Validation\Rule;

enum AssignTypeEnum: string
{
    case SYSTEM = 'system';
    case SCHOOL = 'school';
    case TEACHER = 'teacher';

    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}

class PackagesStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'price'          => 'required|numeric',
            'duration_days'  => 'required|integer',

            // assign_type using enum directly
            'assign_type' => [
                'required',
                Rule::in(AssignTypeEnum::values())
            ],

            'assignable_id' => [
                Rule::requiredIf(fn() => in_array($this->assign_type, [
                    AssignTypeEnum::SCHOOL->value,
                    AssignTypeEnum::TEACHER->value,
                ])),

                Rule::excludeIf(fn() => $this->assign_type === AssignTypeEnum::SYSTEM->value),

                Rule::exists('users', 'id'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The package name is required.',
            'name.string' => 'The package name must be a string.',
            'name.max' => 'The package name must not exceed 255 characters.',

            'price.required' => 'The package price is required.',
            'price.numeric' => 'The package price must be a number.',

            'duration_days.required' => 'The duration (in days) is required.',
            'duration_days.integer' => 'The duration must be an integer.',

            'assign_type.required' => 'The assign type is required.',
            'assign_type.in' => 'The assign type must be one of the following: ' . implode(', ', AssignTypeEnum::values()) . '.',

            'assignable_id.required' => 'The assignable ID is required when the assign type is school or teacher.',
            'assignable_id.exists' => 'The selected assignable ID does not exist.',
        ];
    }
}
