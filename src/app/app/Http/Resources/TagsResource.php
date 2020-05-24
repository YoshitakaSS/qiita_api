<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TagsResource extends ResourceCollection
{
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
                'tagId'          => $resource->tag_id,
                'tagName'        => $resource->tag_name,
                'tagUrl'         => $resource->tag_url,
                'tagCount'       => $resource->count,
                'createDate'     => $resource->created_at,
                'updateDate'     => $resource->updated_at ?? '',
            ];
        }
        return $list;
    }
}
