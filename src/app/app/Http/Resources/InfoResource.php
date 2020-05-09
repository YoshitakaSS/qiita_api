<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class InfoResource extends ResourceCollection
{
    public function __construct($title = '', $description = '')
    {
        $this->title = $title;
        $this->description = $description;
    }
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'description' => $this->description
        ];
    }
}
