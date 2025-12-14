<?php

namespace App\Http\Controllers\Admin\ExamPaper;

use App\Repositories\ExamPaper\ExamPaperRepositoryInterface;
use App\Http\Controllers\BaseController\BaseController;
use App\Http\Requests\Admin\ExamPaper\ExamPaperStoreRequest;
use App\Http\Requests\Admin\ExamPaper\ExamPaperUpdateRequest;
use App\Http\Resources\Admin\ExamPaper\ExamPaperResource;

class ExamPaperController extends BaseController
{
 public function __construct(ExamPaperRepositoryInterface $repository)
 {
  parent::__construct();

  $this->initService(
   repository: $repository,
   collectionName: 'ExamPaper'
  );

  $this->storeRequestClass = ExamPaperStoreRequest::class;
  $this->updateRequestClass = ExamPaperUpdateRequest::class;
  $this->resourceClass = ExamPaperResource::class;
 }
}
