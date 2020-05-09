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
     * @return array
     */
    public function getAllList();

    /**
     * 著者の名前で取得
     *
     * @param string
     * @return array
     */
    public function getListByAuthorName(string $name);

    /**
     * 総数で取得
     *
     * @param int
     * @return array
     */
    public function getListByCount(int $count);

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
