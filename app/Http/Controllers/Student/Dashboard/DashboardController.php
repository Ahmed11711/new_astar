<?php

namespace App\Http\Controllers\Student\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user_id;
        $subjectIds = $request->student_subject_ids;

        $subjects = DB::table('subjects')
            ->whereIn('id', $subjectIds)
            ->get();

        $topicsData = DB::table('topics')
            ->leftJoin('subtopics', 'subtopics.topic_id', '=', 'topics.id')
            ->leftJoin('questions', function ($join) {
                $join->on('questions.topic_id', '=', 'topics.id')
                    ->orOn('questions.subtopics_id', '=', 'subtopics.id');
            })
            ->leftJoin('answers', function ($join) use ($userId) {
                $join->on('answers.question_id', '=', 'questions.id')
                    ->where('answers.user_id', $userId);
            })
            ->whereIn('topics.subject_id', $subjectIds)
            ->select(
                'topics.id as topic_id',
                'topics.name as topic_name',
                'topics.subject_id',
                'subtopics.id as subtopic_id',
                'subtopics.name as subtopic_name',
                DB::raw('COUNT(DISTINCT questions.id) as total_questions'),
                DB::raw('COUNT(DISTINCT answers.id) as answered_questions'),
                DB::raw('SUM(questions.question_max_score) as total_marks'),
                DB::raw('SUM(COALESCE(answers.mark_score,0)) as student_marks')
            )
            ->groupBy('topics.id', 'topics.name', 'topics.subject_id', 'subtopics.id', 'subtopics.name')
            ->get();

        $result = $subjects->map(function ($subject) use ($topicsData) {

            $subjectTopics = $topicsData->where('subject_id', $subject->id)
                ->groupBy('topic_id');

            $topics = $subjectTopics->map(function ($topicGroup) {

                $topic = $topicGroup->first();

                $subtopics = $topicGroup->filter(fn($t) => $t->subtopic_id !== null)->map(function ($sub) {
                    return [
                        'subtopic_name'      => $sub->subtopic_name,
                        'total_marks'        => (int)$sub->total_marks,
                        'student_marks'      => (int)$sub->student_marks,
                        'answered_questions' => (int)$sub->answered_questions,
                        'total_questions'    => (int)$sub->total_questions,
                    ];
                })->values();

                return [
                    'topic_name'         => $topic->topic_name,
                    'total_marks'        => (int)$topic->total_marks,
                    'student_marks'      => (int)$topic->student_marks,
                    'answered_questions' => (int)$topic->answered_questions,
                    'total_questions'    => (int)$topic->total_questions,
                    'subtopics'          => $subtopics,
                ];
            })->values();

            $subjectTotalQuestions = $topics->sum('total_questions');
            $subjectAnsweredQuestions = $topics->sum('answered_questions');

            return [
                'subject_name'              => $subject->name,
                'subject_id'                => $subject->id,
                'topics'                    => $topics,
                'subject_total_questions'   => $subjectTotalQuestions,
                'subject_answered_questions' => $subjectAnsweredQuestions,
            ];
        });

        return response()->json($result);
    }
}
