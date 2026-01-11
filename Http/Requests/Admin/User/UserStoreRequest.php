<?php

namespace App\Http\Requests\Admin\User;

use App\Http\Requests\BaseRequest\BaseRequest;

class UserStoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'is_email_verified' => 'nullable|integer',
            'student_type' => 'nullable|in:individual,school,teacher',
            'role' => 'required|in:admin,school,teacher,student,data_entry',
            'is_active' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'student_type.required' => 'The student type is required.',
            'student_type.in' => 'The student type must be one of the following: individual, school, teacher.',

            'role.required' => 'The role is required.',
            'role.in' => 'The role must be one of the following: admin, school, teacher, student, data_entry.',

            'email.required' => 'The email is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',

            'username.required' => 'The username is required.',
            'first_name.required' => 'The first name is required.',
            'last_name.required' => 'The last name is required.',
            'password.required' => 'The password is required.',
            'is_active.required' => 'The status is required.',
        ];
    }
}
