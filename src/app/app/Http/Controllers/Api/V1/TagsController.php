<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Api\Requests\TagsRequest;
use App\Services\Api\V1\TagsService;

class TagsController extends Controller
{
    protected $service;

    public function __construct(TagsService $tagsService)
    {
        $this->service = $tagsService;
    }

    public function index(TagsRequest $request)
    {
       return $this->service->getAllList($request);
    }
}
