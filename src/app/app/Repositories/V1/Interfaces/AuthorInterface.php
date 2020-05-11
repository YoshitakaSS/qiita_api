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

    // // ------------------
    // // About Insert
    // // ------------------

    // /**
    //  * 著者の詳細を格納する
    //  *
    //  * @param array
    //  * @return bool
    //  */
    // public function storeAuthors(array $author);

    // // ------------------
    // // About Update
    // // ------------------

    // /**
    //  * 著者の詳細を更新する
    //  *
    //  * @param array
    //  * @return bool
    //  */
    // public function updateAuthors(array $author);
}
