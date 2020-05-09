<?php
namespace App\Services\Api\V1;

use App\Repositories\V1\Interfaces\AuthorInterface;
use App\Http\Resources\InfoResource;
use App\Http\Resources\AuthorsResource;

class AuthorService
{
    private $authorRepository;
    protected $infoResource;
    protected $authorResource;

    public function __construct(AuthorInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
        $this->infoResource = new InfoResource(
            'Author List API',
            'Returns a list of authors trending in Qiita'
        );

    }

    public function getAllList()
    {
        $authorsList = $this->authorRepository->getAllList();

        $authorResource = new AuthorsResource($authorsList);

        return [
            'Info' => $this->infoResource,
            'List' => $authorResource
        ];
    }

    public function getListByAuthorName($name)
    {
        $this->authorRepository->getListByAuthorName($name);
    }

    public function getListByCount($count)
    {
        $this->authorRepository->getListByCount($count);
    }
}
