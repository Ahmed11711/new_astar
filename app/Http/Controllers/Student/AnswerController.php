<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\Answer\SaveAnswerRequest;
use App\Models\answer;
use App\Models\StudentAttamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnswerController extends Controller
{
    public function saveAnswersOptimized(SaveAnswerRequest $request)
    {
        $attempt = StudentAttamp::where('id', $request->attempt_id)
            ->where('user_id', $request->user_id)
            ->first();

        if (!$attempt) {
            return response()->json([
                'message' => 'Attempt not found or does not belong to this user'
            ], 404);
        }

        $answersData = $request->input('answers', []);

        $upsertData = collect($answersData)->map(function ($a) use ($attempt) {
            return [
                'attempt_id'     => $attempt->id,
                'question_id'    => $a['question_id'],
                'question_index' => $a['question_index'],
                'response'       => json_encode($a['response']),
                'is_flagged'     => $a['is_flagged'] ?? false,
                'created_at'     => now(),
                'updated_at'     => now(),
            ];
        })->toArray();

        DB::transaction(function () use ($upsertData, $attempt, $request) {
            Answer::upsert(
                $upsertData,
                ['attempt_id', 'question_id', 'question_index'],
                ['response', 'is_flagged', 'updated_at']
            );

            $attempt->update([
                'is_saved' => $request->is_saved
            ]);
        });

        return response()->json([
            'detail' => 'All answers saved successfully.'
        ]);
    }
}
