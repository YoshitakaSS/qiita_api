<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ListsReosource extends ResourceCollection
{
    const ROOT_URL = 'https://qiita.com/';

    public function __construct($resource)
    {
        $this->resources = $resource;
    }

    public function toArray()
    {
        $list = [];
        foreach ($this->resources as $resource) {
            $list[] = [
                'articleId'             => $resource->article_id,
                'articleTitle'          => $resource->article_title,
                'articleUrl'            => self::ROOT_URL . $resource->article_url,
                'authorName'            => $resource->author_name,
                'likesCount'            => $resource->count,
                'tagList'               => $resource->tag_list,
                'create_at'             => $resource->created_at,
                'update_at'             => $resource->updated_at,
            ];
        }
    }
}
