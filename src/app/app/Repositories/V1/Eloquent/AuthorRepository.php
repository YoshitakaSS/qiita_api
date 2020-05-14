<?php

namespace App\Repositories\V1\Eloquent;

use App\Repositories\V1\Eloquent\Models\Author;
use App\Repositories\V1\Interfaces\AuthorInterface;

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
    public function getAllList($request)
    {
        if (!empty($request->name)) {
            return $this->author
                    ->where('author_name', $request->name)
                    ->get();
        }

        if (!empty($request->count)) {
            return $this->author
                    ->where('count', '>=', $request->count)
                    ->get();
        }

        return $this->author
                    ->limit(30)
                    ->get();
    }

    public function getAuthorByName($authorName)
    {
        return $this->author
                    ->where('author_name', $authorName)
                    ->first();
    }

    /**
     * 著者の一覧をInsertする
     *
     * @param string $author
     */
    public function storeAuthors($author)
    {
        return $this->author
                    ->insert([
                        'author_name' => $author,
                        'count' => 1,
                        'create_at' => date('Y-m-d H:m:s')
                    ]);
    }

    public function updateAuthors($author, $count = 1)
    {
        return $this->author
                    ->where('author_name', $author)
                    ->update([
                        'count' => ++$count,
                    ]);
    }
}
