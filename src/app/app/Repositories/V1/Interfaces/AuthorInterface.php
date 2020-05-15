<?php
namespace App\Repositories\V1\Interfaces;

interface AuthorInterface
{
    // ------------------
    // About Get
    // ------------------

    /**
     * 著者の一覧を返却
     *
     * @param AuthorRequest $request
     * @return array
     */
    public function getAllList($request);

    public function getAuthorByName(string $authorName);

    /**
     * 著者の詳細を格納する
     *
     * @param array
     * @return bool
     */
    public function storeAuthors(string $author);

    public function updateAuthors(string $author, int $count = 1);
}
