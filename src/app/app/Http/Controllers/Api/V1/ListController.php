<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\Api\V1\ListService;
use App\Http\Api\Requests\ListRequest;

class ListController extends Controller
{
    private $listService;


    public function __construct(ListService $listService)
    {
        $this->listService = $listService;
    }

    public function index(ListRequest $request)
    {
        return $this->listService->getAllList($request);
    }
}
