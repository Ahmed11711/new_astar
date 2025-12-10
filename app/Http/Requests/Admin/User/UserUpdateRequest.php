<?php

namespace App\Http\Requests\Admin\User;
use App\Http\Requests\BaseRequest\BaseRequest;
class UserUpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'sometimes|required|string|max:255|unique:users,username,'.$this->route('user').',id',
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|max:255|unique:users,email,'.$this->route('user').',id',
            'password' => 'sometimes|required|string|max:255',
            'phone' => 'nullable|sometimes|string|max:255',
            'is_email_verified' => 'sometimes|required|integer',
            'student_type' => 'sometimes|required|in:individual,school,teacher',
            'role' => 'sometimes|required|in:admin,school,teacher,student,data_entry',
            'is_active' => 'sometimes|required|integer',
        ];
    }
}
