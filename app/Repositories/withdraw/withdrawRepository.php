<?php

namespace App\Repositories\withdraw;

use App\Repositories\withdraw\withdrawRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\withdraw;

class withdrawRepository extends BaseRepository implements withdrawRepositoryInterface
{
    public function __construct(withdraw $model)
    {
        parent::__construct($model);
    }
}
