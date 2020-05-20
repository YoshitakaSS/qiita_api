<?php
namespace App\Repositories\V1\Interfaces;

interface TagsInterface
{
    public function getAllList($request);

    public function getTagsByTagName(string $tagName);

    public function storeTags($tagsList);

    public function updateTagsCount($tagList);
}
