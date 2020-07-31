<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AuthorsResource extends ResourceCollection
{
    const ROOT_URL = 'https://qiita.com/';

    private $authorResource;


    public function __construct($resource)
    {
        $this->authorResource = $resource;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $list = [];
        foreach ($this->authorResource as $resource) {
            $list[] = [
                'authorId'      => $resource->author_id,
                'authorName'    => $resource->author_name,
                'authorCount'   => $resource->count,
                'authorUrl'     => self::ROOT_URL . $resource->author_name,
                'create_at'     => $resource->created_at,
                'update_at'     => $resource->updated_at,
            ];
        }
        return $list;
    }
}
