<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AuthorsResource extends ResourceCollection
{
    const ROOT_URL = 'https://qiita.com/';

    // private $resources;


    public function __construct($resource)
    {
        $this->resources = $resource;
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
        foreach ($this->resources as $resource) {
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

        // return [
        //     'authorId'      => $this->author_id,
        //     'authorName'    => $this->author_name,
        //     'authorCount'   => $this->count,
        //     'authorUrl'     => self::ROOT_URL . $this->author_name,
        //     'create_at'     => $this->created_at,
        //     'update_at'     => $this->updated_at,
        // ];
    }
}
