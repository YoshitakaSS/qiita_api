<?php

namespace App\Services\Api\V1;

use App\Repositories\V1\Interfaces\ListsInterface;
use App\Http\Resources\ListsReosource;
use App\Http\Resources\InfoResource;

class ListsService
{
    protected $infoResource;
    protected $listsRepository;

    public function __construct(ListsReosource $listsRepository)
    {
        $this->listsRepository = $listsRepository;
        $this->infoResource = new InfoResource(
            'Article List API',
            'Returns a list of article trending in Qiita'
        );

    }

    public function getAllList()
    {

    }

}
