<?php

namespace App\Repositories\Packages;

use App\Repositories\Packages\PackagesRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\Packages;

class PackagesRepository extends BaseRepository implements PackagesRepositoryInterface
{
    public function __construct(Packages $model)
    {
        parent::__construct($model);
    }
}
