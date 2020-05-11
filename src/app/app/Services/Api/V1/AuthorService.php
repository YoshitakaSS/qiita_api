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

    /**
     * 著者の一覧を返す
     *
     * @param AuthorRequest $request
     * @return array
     */
    public function getAllList($request)
    {
        $authorsList = $this->authorRepository->getAllList($request);

        $authorResource = new AuthorsResource($authorsList);

        return [
            'Info' => $this->infoResource,
            'List' => $authorResource
        ];
    }
}
