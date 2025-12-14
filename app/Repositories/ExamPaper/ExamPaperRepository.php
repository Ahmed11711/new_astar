<?php

namespace App\Repositories\ExamPaper;

use App\Repositories\ExamPaper\ExamPaperRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\ExamPaper;

class ExamPaperRepository extends BaseRepository implements ExamPaperRepositoryInterface
{
    public function __construct(ExamPaper $model)
    {
        parent::__construct($model);
    }
}
