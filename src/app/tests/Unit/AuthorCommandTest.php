<?php

namespace Tests\Unit;

use App\Repositories\V1\Eloquent\Models\Author;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\Console\Output\BufferedOutput;
use Tests\TestCase;

class AuthorCommandTest extends TestCase
{
    use RefreshDatabase;

    private $author;

    public function setUp():void
    {
        parent::setUp();
        // データをセット
        // $this->setData();
    }

    /**
     * ArtisanCommand（batch）で生成されたデータが正しいのか検証する
     */
    public function testAuthorCommand()
    {
        // 自作コマンドを実行する
        Artisan::call('command:insertAuthors', []);

        $authorJson = file_get_contents(__DIR__ . '/Resources/AuthorUnitResource.json');
        $authorList = json_decode($authorJson, true);

        // Modelを使用してデータが入ったのか確認する
        // $this->author = new Author();
        $this->author = factory(Author::class)->make();
    }

    protected function setData()
    {
        factory(Author::class)->create([
            'author_id' => 121,
            'author_name' => 'hoge',
            'count' => 1,
            'created_at' => '2020-10-10 21:00:00',
            'updated_at' => '2020-10-10 22:00:00',
        ]);
        factory(Author::class)->create([
            'author_id' => 140,
            'author_name' => 'fuga',
            'count' => 1,
            'created_at' => '2020-11-11 21:00:00',
            'updated_at' => '2020-12-10 22:00:00',
        ]);
        factory(Author::class)->create([
            'author_id' => 124,
            'author_name' => 'saga',
            'count' => 1,
            'created_at' => '2020-12-23 21:00:00',
            'updated_at' => '2020-12-25 22:30:00',
        ]);
        factory(Author::class)->create([
            'author_id' => 124,
            'author_name' => 'test-user',
            'count' => 1,
            'created_at' => '2020-12-24 21:00:00',
            'updated_at' => '2020-12-25 22:31:00',
        ]);
    }
}
