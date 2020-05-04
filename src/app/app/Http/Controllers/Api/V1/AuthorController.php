<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Api\Requests\AuthorRequest;
use App\Services\V1\AuthorService;

class AuthorController extends Controller
{
    public function __construct()
    {
        $service = new AuthorService();
    }

    public function index(AuthorRequest $request)
    {
        return 'hoge';
    }

    public function store()
    {

    }

    public function update()
    {

    }
}
