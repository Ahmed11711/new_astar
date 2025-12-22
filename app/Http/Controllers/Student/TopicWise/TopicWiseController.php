<?php

namespace App\Http\Controllers\Student\TopicWise;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TopicWiseController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user_id;
        $data = $request->validate();

        return $data;
    }
}
