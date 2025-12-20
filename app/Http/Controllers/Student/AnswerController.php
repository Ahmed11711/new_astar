<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\Answer\SaveAnswerRequest;
use App\Models\answer;
use App\Models\StudentAttamp;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function saveAnswersOptimized(SaveAnswerRequest $request)
    {
        $userid = $request->user_id;
        $attemptId = $request['attempt_id'];

        $attempt = StudentAttamp::where('id', $attemptId)
            ->where('user_id', $userid)
            ->first();


        $answersData = $request->input('answers', []);

        $upsertData = [];
        foreach ($answersData as $a) {
            $upsertData[] = [
                'attempt_id'     => $attemptId,
                'question_id'    => $a['question_id'] ?? null,
                'question_index' => $a['question_index'] ?? null,
                'response'       => json_encode($a['response']),
                'is_flagged'     => $a['is_flagged'] ?? false,
                'updated_at'     => now(),
                'created_at'     => now(),
            ];
        }

        answer::upsert(
            $upsertData,
            ['attempt_id', 'question_id', 'question_index'], // combination key
            ['response', 'is_flagged', 'updated_at']         // columns to update
        );

        return response()->json([
            'detail' => 'All answers saved successfully.',
        ]);
    }
}
