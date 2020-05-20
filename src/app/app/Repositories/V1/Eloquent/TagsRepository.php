<?php

namespace App\Repositories\V1\Eloquent;

use App\Repositories\V1\Eloquent\Models\Tags;
use App\Repositories\V1\Interfaces\TagsInterface;

class TagsRepository implements TagsInterface
{
    const ROOT_URL = 'https://qiita.com';
    protected $tags;

    public function __construct(Tags $tags)
    {
        $this->tags = $tags;
    }

    public function getAllList($request)
    {
        if (!empty($request->name)) {
            return $this->tags
                    ->where('tags_name', $request->name)
                    ->get();
        }

        if (!empty($request->count)) {
            return $this->tags
                    ->where('count', '>=', $request->count)
                    ->get();
        }

        return $this->tags
                    ->limit(30)
                    ->get();
    }

    public function getTagsByTagName($tagName)
    {
        return $this->tags
                    ->where('tag_name', $tagName)
                    ->get();
    }

    public function storeTags($tagsList)
    {
        return $this->tags
                    ->insert([
                        'tag_name'   => $tagsList['tag_name'],
                        'tag_url'    => self::ROOT_URL . $tagsList['tag_link'],
                        'tag_count'      => 1,
                        'created_at' => date('Y-m-d H:m:s')
                    ]);
    }

    public function updateTagsCount($tagList)
    {

    }

}
