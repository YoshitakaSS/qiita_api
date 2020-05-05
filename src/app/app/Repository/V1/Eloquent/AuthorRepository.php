<?php

namespace App\Repositories\V1\Eloquent;

use App\Repositories\V1\Eloquent\Models\Author;
use App\Repositories\V1\Intefaces\AuthorInterface;

class AuthorRepository implements AuthorInterface
{
    private $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    /**
     * 著者の一覧を返却
     *
     * @return array
     */
    public function getAllList()
    {
        return $this->author
                    ->limit(30)
                    ->get();
    }

    /**
     * 著者の名前で取得
     *
     * @param string
     * @return array
     */
    public function getListByAuthorName(string $name)
    {
        return $this->author
                    ->where('author_name', $name)
                    ->get();
    }

    /**
     * 総数以上を取得
     *
     * @param int
     * @return array
     */
    public function getListByCount(int $count)
    {
        return $this->author
                    ->where('count', '<=', $count)
                    ->get();
    }
}
