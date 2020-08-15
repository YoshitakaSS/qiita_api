<?php

namespace App\Repositories\V1\Eloquent;

use App\Repositories\V1\Eloquent\Models\Author;
use App\Repositories\V1\Interfaces\AuthorInterface;
use App\Repositories\V1\Cache\Cache;

class AuthorRepository implements AuthorInterface
{
    private $author;
    private $primary = 'authorName';

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
        $author = $this->author;
        if (!empty($request->name)) {
            $keys = [
                $this->primary => $request->name
            ];

            $value = Cache::getValue(__CLASS__, __FUNCTION__, $keys);

            // キャッシュに値がなければDBアクセス
            if (empty($value)) {
                $value = $author->where('author_name', $request->name)->get();
                // キャッシュする
                Cache::setValue(__CLASS__, __FUNCTION__, $keys, $value);
            }
            return collect($value);
        }

        if (!empty($request->count)) {
            $author = $author->where('count', '>=', $request->count);
        }

        return $author->limit(30)
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
                        'created_at' => date('Y-m-d H:m:s')
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
