<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\Api\V1\ListsService;
use App\Http\Api\Requests\ListsRequest;

class ListController extends Controller
{
    private $listsService;


    public function __construct(ListsService $listsService)
    {
        $this->listsService = $listsService;
    }

    public function index(ListsRequest $request)
    {
        return $this->listsService->getAllList($request);
    }
}
