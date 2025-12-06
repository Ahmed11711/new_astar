<?php

namespace App\Http\Controllers\Admin\notifications;

use App\Repositories\notifications\notificationsRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\notifications\notificationsStoreRequest;
use App\Http\Requests\Admin\notifications\notificationsUpdateRequest;
use App\Http\Resources\Admin\notifications\notificationsResource;

class notificationsController extends BaseController
{
    public function __construct(notificationsRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'notifications'
        );

        $this->storeRequestClass = notificationsStoreRequest::class;
        $this->updateRequestClass = notificationsUpdateRequest::class;
        $this->resourceClass = notificationsResource::class;
    }
}
