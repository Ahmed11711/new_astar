<?php

namespace App\Repositories\paper;

use App\Repositories\paper\paperRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\paper;

class paperRepository extends BaseRepository implements paperRepositoryInterface
{
    public function __construct(paper $model)
    {
        parent::__construct($model);
    }
}
