<?php

namespace App\Repositories\notifications;

use App\Repositories\notifications\notificationsRepositoryInterface;
use App\Repositories\BaseRepository\BaseRepository;
use App\Models\notifications;

class notificationsRepository extends BaseRepository implements notificationsRepositoryInterface
{
    public function __construct(notifications $model)
    {
        parent::__construct($model);
    }
}
