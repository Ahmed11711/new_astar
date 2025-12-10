<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
 /**
  * Run the database seeds.
  */
 public function run(): void
 {
  $now = now();

  DB::table('users')->insert([
   [
    'username'       => 'admin',
    'first_name'     => 'Super',
    'last_name'      => 'Admin',
    'email'          => 'admin@example.com',
    'password'       => Hash::make('password123'),
    'phone'          => '01000000000',
    'is_email_verified' => true,
    'student_type'   => 'individual',
    'role'           => 'admin',
    'is_active'      => true,
    'created_at'     => $now,
    'updated_at'     => $now,
   ],
   [
    'username'       => 'teacher1',
    'first_name'     => 'John',
    'last_name'      => 'Doe',
    'email'          => 'teacher1@example.com',
    'password'       => Hash::make('password123'),
    'phone'          => '01011111111',
    'is_email_verified' => true,
    'student_type'   => 'teacher',
    'role'           => 'teacher',
    'is_active'      => true,
    'created_at'     => $now,
    'updated_at'     => $now,
   ],
   [
    'username'       => 'student1',
    'first_name'     => 'Jane',
    'last_name'      => 'Smith',
    'email'          => 'student1@example.com',
    'password'       => Hash::make('password123'),
    'phone'          => '01022222222',
    'is_email_verified' => false,
    'student_type'   => 'school',
    'role'           => 'student',
    'is_active'      => true,
    'created_at'     => $now,
    'updated_at'     => $now,
   ],
  ]);
 }
}
