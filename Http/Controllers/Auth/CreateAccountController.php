<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreateAccountRequest;
use App\Http\Service\Auth\CreateAccountService;
use App\Models\StudentAssignment;
use App\Models\User;
use App\Models\UserGrade;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateAccountController extends Controller
{
    use ApiResponseTrait;
    public function createAccount(CreateAccountRequest $request)
    {
        $user = app(CreateAccountService::class)
            ->execute($request->validated());

        return $this->successResponse($user, 'Account created successfully');
    }
}
