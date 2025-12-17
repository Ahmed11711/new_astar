<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest\BaseRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Models\Package;
use App\Models\Packages;

class CreateAccountRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            // ======================
            // Basic User Info
            // ======================
            'username'   => ['required', 'string', 'max:255', 'unique:users,username'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'unique:users,email'],
            'phone'      => ['nullable', 'string', 'max:20'],

            // ======================
            // Role
            // ======================
            'role' => [
                'required',
                Rule::in(['student', 'teacher', 'school', 'data_entry']),
            ],

            // ======================
            // Security
            // ======================
            'password' => [
                'required',
                Password::min(8)->mixedCase()->numbers(),
            ],

            // ======================
            // Student Specific
            // ======================
            'student_type' => [
                Rule::requiredIf(fn() => $this->role === 'student'),
                Rule::in(['school', 'teacher', 'individual']),
            ],

            'grade_id' => [
                Rule::requiredIf(fn() => $this->role === 'student'),
                'integer',
                'exists:grades,id',
            ],

            // ======================
            // Assignment (School / Teacher)
            // ======================
            'assigned_type' => [
                Rule::requiredIf(fn() => $this->role === 'student' && in_array($this->student_type, ['school', 'teacher'])),
                Rule::in(['school', 'teacher']),
            ],

            'assigned_id' => [
                Rule::requiredIf(fn() => $this->role === 'student' && in_array($this->student_type, ['school', 'teacher'])),
                'integer',
            ],

            // ======================
            // Package
            // ======================
            'package_id' => [
                Rule::requiredIf(fn() => $this->role === 'student'),
                'integer',
            ],

            // ======================
            // Subjects
            // ======================
            'subject_ids' => [
                Rule::requiredIf(fn() => $this->role === 'student' && $this->student_type !== 'individual'),
                'array',
            ],

            'subject_ids.*' => [
                'integer',
                'exists:subjects,id',
            ],
        ];
    }

    /**
     * Business-level validation
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {

            if ($this->role !== 'student') {
                return;
            }

            // ======================
            // Validate Assigned Account
            // ======================
            if (in_array($this->student_type, ['school', 'teacher'])) {

                $exists = User::where('id', $this->assigned_id)
                    ->where('role', $this->assigned_type)
                    ->exists();

                if (! $exists) {
                    $validator->errors()->add(
                        'assigned_id',
                        'Assigned account does not match the selected type.'
                    );
                }
            }

            // ======================
            // Validate Package Ownership
            // ======================
            $validPackage = Packages::where('id', $this->package_id)
                ->where(function ($q) {
                    $q->where('assign_type', 'system')
                        ->orWhere(function ($q) {
                            $q->where('assign_type', $this->assigned_type)
                                ->where('assignable_id', $this->assigned_id);
                        });
                })
                ->exists();

            if (! $validPackage) {
                $validator->errors()->add(
                    'package_id',
                    'Selected package is not available for this account.'
                );
            }
        });
    }

    /**
     * Custom messages
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Username is required.',
            'username.unique'   => 'This username is already taken.',

            'first_name.required' => 'First name is required.',
            'last_name.required'  => 'Last name is required.',

            'email.required' => 'Email is required.',
            'email.email'    => 'Email must be valid.',
            'email.unique'   => 'Email is already registered.',

            'role.required' => 'Role is required.',
            'role.in'       => 'Invalid role selected.',

            'password.required' => 'Password is required.',
            'password.min'      => 'Password must be at least 8 characters.',

            'student_type.required' => 'Student type is required for students.',
            'student_type.in'       => 'Invalid student type.',

            'grade_id.required' => 'Grade is required for students.',
            'grade_id.exists'   => 'Selected grade does not exist.',

            'assigned_type.required' => 'Assigned type is required.',
            'assigned_type.in'       => 'Assigned type must be school or teacher.',

            'assigned_id.required' => 'Assigned account is required.',
            'assigned_id.integer'  => 'Assigned account must be valid.',

            'package_id.required' => 'Package is required.',
            'package_id.integer'  => 'Package must be valid.',

            'subject_ids.required' => 'Subjects are required.',
            'subject_ids.array'    => 'Subjects must be an array.',
        ];
    }
}
