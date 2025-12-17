<?php

namespace App\Http\Service\Auth;

use App\Models\Packages;
use App\Models\User;
use App\Models\StudentAssignment;
use App\Models\StudentPackage;
use App\Models\UserGrade;
use App\Models\UserPackage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreateAccountService
{
    public function execute(array $data): User
    {
        return DB::transaction(function () use ($data) {

            // ======================
            // Create User
            // ======================
            $user = User::create([
                'username'     => $data['username'],
                'first_name'   => $data['first_name'],
                'last_name'    => $data['last_name'],
                'email'        => $data['email'],
                'phone'        => $data['phone'],
                'role'         => $data['role'],
                'student_type' => $data['student_type'] ?? null,
                'is_active'    => true,
                'password'     => Hash::make($data['password']),
            ]);

            // ======================
            // Stop here if not student
            // ======================
            if ($user->role !== 'student') {
                return $user;
            }

            // ======================
            // Student related data
            // ======================
            $this->assignStudent($user, $data);
            $this->assignGrade($user, $data);
            $this->assignPackage($user, $data);

            return $user;
        });
    }

    /**
     * Assign student to school or teacher
     */
    protected function assignStudent(User $user, array $data): void
    {
        if (!isset($data['assigned_id'], $data['assigned_type'])) {
            return;
        }

        StudentAssignment::create([
            'student_id'    => $user->id,
            'assigned_type' => $data['assigned_type'],
            'assigned_id'   => $data['assigned_id'],
        ]);
    }

    /**
     * Assign grade
     */
    protected function assignGrade(User $user, array $data): void
    {
        if (!isset($data['grade_id'])) {
            return;
        }

        UserGrade::create([
            'user_id'  => $user->id,
            'grade_id' => $data['grade_id'],
        ]);
    }

    /**
     * Assign package to student
     */
    protected function assignPackage(User $user, array $data): void
    {
        if (!isset($data['package_id'])) {
            return;
        }

        StudentPackage::create([
            'user_id'    => $user->id,
            'package_id' => $data['package_id'],
            'starts_at'  => Carbon::now(),
            'ends_at'    => Carbon::now()->addDays(
                optional($this->getPackageDuration($data['package_id'])) ?? 30
            ),
            'is_active'  => true,
        ]);
    }

    /**
     * Get package duration safely
     */
    protected function getPackageDuration(int $packageId): ?int
    {
        return Packages::where('id', $packageId)
            ->value('duration_days');
    }
}
