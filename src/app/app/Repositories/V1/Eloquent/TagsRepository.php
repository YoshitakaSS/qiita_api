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
        $tags = $this->tags;
        if (!empty($request->name)) {
            $tags = $tags->where('tag_name', $request->name);
        }

        if (!empty($request->count)) {
            $tags = $tags->where('count', '>=', $request->count);
        }

        if (!empty($request->created_at)) {
            $tags = $tags->where('create_at', '=', $request->created_at);
        }

        return $tags->limit(30)
                    ->get();
    }

    public function getTagsByTagName($tagName)
    {
        return $this->tags
                    ->where('tag_name', $tagName)
                    ->first();
    }

    public function storeTags($tagsList)
    {
        return $this->tags
                    ->insert([
                        'tag_name'   => $tagsList['tag_name'],
                        'tag_url'    => self::ROOT_URL . $tagsList['tag_link'],
                        'count'  => 1,
                        'created_at' => date('Y-m-d H:m:s')
                    ]);
    }

    public function updateTagsCount($tagName, $count = 1)
    {
        return $this->tags
                    ->where('tag_name', $tagName)
                    ->update([
                        'count' => ++$count,
                    ]);
    }

}
