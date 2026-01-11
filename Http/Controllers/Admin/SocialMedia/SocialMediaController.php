<?php

namespace App\Http\Controllers\Admin\SocialMedia;

use App\Repositories\SocialMedia\SocialMediaRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\SocialMedia\SocialMediaStoreRequest;
use App\Http\Requests\Admin\SocialMedia\SocialMediaUpdateRequest;
use App\Http\Resources\Admin\SocialMedia\SocialMediaResource;

class SocialMediaController extends BaseController
{
    public function __construct(SocialMediaRepositoryInterface $repository)
    {
        parent::__construct();

        $this->initService(
            repository: $repository,
            collectionName: 'SocialMedia'
        );

        $this->storeRequestClass = SocialMediaStoreRequest::class;
        $this->updateRequestClass = SocialMediaUpdateRequest::class;
        $this->resourceClass = SocialMediaResource::class;
    }
}
