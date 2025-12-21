<?php

namespace App\Repositories\Attmpate;

use App\Models\Blog;
use App\Models\StudentAttamp;
use App\Repositories\Attmpate\AttmpateRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;

class AttmpateRepository extends BaseRepository implements AttmpateRepositoryInterface
{
    public function __construct(StudentAttamp $model)
    {
        parent::__construct($model);
    }
}
