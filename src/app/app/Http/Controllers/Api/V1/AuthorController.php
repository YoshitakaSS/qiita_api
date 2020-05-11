<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Api\Requests\AuthorRequest;
use App\Services\Api\V1\AuthorService;

class AuthorController extends Controller
{
    protected $service;

    public function __construct(AuthorService $authorService)
    {
        $this->service = $authorService;
    }

    public function index(AuthorRequest $request)
    {
        return $this->service->getAllList($request);
    }

    public function store()
    {

    }

    public function update()
    {

    }
}
