<?php
namespace App\Services\Api\V1;

use App\Repositories\V1\Interfaces\TagsInterface;
use App\Http\Resources\InfoResource;
use App\Http\Resources\TagsResource;

class TagsService
{
    protected $infoResource;
    protected $tagsRepository;

    public function __construct(TagsInterface $tagsRepository)
    {
        $this->tagsRepository = $tagsRepository;
        $this->infoResource = new InfoResource(
            'Tags List API',
            'Returns a list of tags trending in Qiita'
        );
    }

    /**
     * タグの一覧を返す
     *
     * @param TagsRequest $request
     * @param array
     */
    public function getAllList($request)
    {
        $tagsList = $this->tagsRepository->getAllList($request);

        $tagsResource = new TagsResource($tagsList);

        return [
            'Info' => $this->infoResource,
            'List' => $tagsResource
        ];
    }

}
