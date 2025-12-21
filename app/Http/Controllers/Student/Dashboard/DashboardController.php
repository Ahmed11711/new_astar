<?php

namespace App\Http\Controllers\Student\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\SubTopic;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user_id;
        $subjectIds = $request->student_subject_ids;

        $topics = Topic::whereIn('subject_id', $subjectIds)
            ->with([
                'questions.answers' => function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                },
                'subTopic.questions.answers' => function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                }
            ])
            ->get();

        $result = $topics->map(function ($topic) {
            $topicTotalMarks = $topic->questions->sum('question_max_score');
            $topicStudentMarks = $topic->questions->sum(function ($q) {
                return $q->answers->sum('mark_score');
            });
            $topicAnsweredQuestions = $topic->questions->filter(function ($q) {
                return $q->answers->isNotEmpty();
            })->count();

            $subTopics = optional($topic->subTopics)->map(function ($sub) {
                $subTotalMarks = $sub->questions->sum('question_max_score');
                $subStudentMarks = $sub->questions->sum(function ($q) {
                    return $q->answers->sum('mark_score');
                });
                $subAnsweredQuestions = $sub->questions->filter(function ($q) {
                    return $q->answers->isNotEmpty();
                })->count();

                return [
                    'subtopic_name' => $sub->name,
                    'total_marks' => $subTotalMarks,
                    'student_marks' => $subStudentMarks,
                    'answered_questions' => $subAnsweredQuestions,
                ];
            }) ?? [];


            return [
                'topic_name' => $topic->name,
                'total_marks' => $topicTotalMarks,
                'student_marks' => $topicStudentMarks,
                'answered_questions' => $topicAnsweredQuestions,
                'subtopics' => $subTopics,
            ];
        });

        return response()->json($result);
    }
}
