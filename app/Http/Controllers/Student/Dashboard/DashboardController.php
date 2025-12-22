<?php

namespace App\Http\Controllers\Student\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\SubTopic;
use Illuminate\Http\Request;
use App\Models\Subject;


class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $userId = $request->user_id;
        $subjectIds = $request->student_subject_ids;

        $subjects = Subject::whereIn('id', $subjectIds)
            ->with([
                'topics.questions.answers' => function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                },
                'topics.subTopics.questions.answers' => function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                },
            ])
            ->get();

        $result = $subjects->map(function ($subject) {

            $topics = $subject->topics->map(function ($topic) {

                $topicTotalMarks = $topic->questions->sum('question_max_score');
                $topicStudentMarks = $topic->questions->sum(
                    fn($q) => $q->answers->sum('mark_score')
                );
                $topicAnsweredQuestions = $topic->questions
                    ->where(fn($q) => $q->answers->isNotEmpty())
                    ->count();

                $subTopics = $topic->subTopics->map(function ($sub) {

                    $subTotalMarks = $sub->questions->sum('question_max_score');
                    $subStudentMarks = $sub->questions->sum(
                        fn($q) => $q->answers->sum('mark_score')
                    );
                    $subAnsweredQuestions = $sub->questions
                        ->where(fn($q) => $q->answers->isNotEmpty())
                        ->count();

                    return [
                        'subtopic_name'       => $sub->name,
                        'total_marks'         => $subTotalMarks,
                        'student_marks'       => $subStudentMarks,
                        'answered_questions'  => $subAnsweredQuestions,
                    ];
                });

                return [
                    'topic_name'          => $topic->name,
                    'total_marks'         => $topicTotalMarks,
                    'student_marks'       => $topicStudentMarks,
                    'answered_questions'  => $topicAnsweredQuestions,
                    'subtopics'           => $subTopics,
                ];
            });

            return [
                'subject_name' => $subject->name,
                'subject_id' => $subject->id,
                'topics'       => $topics,
            ];
        });

        return response()->json($result);
    }
}
