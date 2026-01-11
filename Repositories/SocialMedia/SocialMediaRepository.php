<?php

namespace App\Repositories\SocialMedia;

use App\Repositories\SocialMedia\SocialMediaRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\SocialMedia;

class SocialMediaRepository extends BaseRepository implements SocialMediaRepositoryInterface
{
    public function __construct(SocialMedia $model)
    {
        parent::__construct($model);
    }
}
