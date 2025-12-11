<?php

namespace App\Http\Controllers\Admin\paper;

use App\Repositories\paper\paperRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\paper\paperStoreRequest;
use App\Http\Requests\Admin\paper\paperUpdateRequest;
use App\Http\Resources\Admin\paper\paperResource;

class paperController extends BaseController
{
    public function __construct(paperRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'paper'
        );

        $this->storeRequestClass = paperStoreRequest::class;
        $this->updateRequestClass = paperUpdateRequest::class;
        $this->resourceClass = paperResource::class;
    }
}
