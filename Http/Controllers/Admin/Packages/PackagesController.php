<?php

namespace App\Http\Controllers\Admin\Packages;

use App\Repositories\Packages\PackagesRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\Packages\PackagesStoreRequest;
use App\Http\Requests\Admin\Packages\PackagesUpdateRequest;
use App\Http\Resources\Admin\Packages\PackagesResource;

class PackagesController extends BaseController
{
    public function __construct(PackagesRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'Packages'
        );

        $this->storeRequestClass = PackagesStoreRequest::class;
        $this->updateRequestClass = PackagesUpdateRequest::class;
        $this->resourceClass = PackagesResource::class;
    }
}
