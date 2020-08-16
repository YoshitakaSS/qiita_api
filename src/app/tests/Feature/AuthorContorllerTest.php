<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Repositories\V1\Eloquent\Models\Author;
use Illuminate\Support\Facades\Artisan;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\ClientInterface;


class AuthorContorllerTest extends TestCase
{
    use RefreshDatabase;

    const AUTHOR_ROUTE = '/api/v1/author';

    /**
     * テスト実行前に一番最初に実行する
     * テストデータを挿入する
     */
    public function setUp():void
    {
        parent::setUp();

        // テーブルを初期化
        Author::truncate();

        // テストデータ挿入
        // $this->setData();

        // artisanコマンドの実行（Seederがちゃんとしてればこっちの方が良い
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed --class=AuthorsSeeder');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAuthorRoute()
    {
        $response = $this->get(self::AUTHOR_ROUTE);
        $response
            ->assertStatus(200)
            ->assertJsonCount(3, $key = 'List');
    }

    /**
     * 存在するデータを取得する際の挙動
     */
    public function testAuthorRequestName()
    {
        $expectedJson = file_get_contents(__DIR__ . '/../Resources/AuthorResource/AuthorResourceJson.json');
        $expectedStructure = [
            'Info' => [
                'title',
                'description'
            ],
            'List' => [
                0 => [
                    'authorId',
                    'authorName',
                    'authorCount',
                    'authorUrl',
                    'create_at',
                    'update_at',
                ]
            ],
        ];
        // モッククライアントを作成
        // $expectRes = new Response(200, [], $expectedJson);
        // $mock = new MockHandler([$expectRes]);
        // $handler = HandlerStack::create($mock);
        // $mockClient = new Client(['handler' => $handler]);
        $route = self::AUTHOR_ROUTE . '?name=qiita_user_1';
        // $response = $mockClient->get($route)
        $response = $this->get($route);

        $response
            ->assertStatus(200)
            ->assertJsonCount(1, $key = 'List')
            ->assertJsonStructure($expectedStructure);
    }

    /**
     * 存在しないデータを取得する挙動
     */
    public function testAuthorReuquestNameNotExists()
    {
        $route = self::AUTHOR_ROUTE . '?name=hoge';
        $response = $this->get($route);

        $response
            ->assertStatus(200)
            ->assertJsonCount(0, $key = 'List');
    }

    protected function setData()
    {
        factory(Author::class)->create([
            'author_id' => 121,
            'author_name' => 'qiita_user_1',
            'count' => 100,
            'created_at' => '2020-10-10 21:00:00',
            'updated_at' => '2020-10-10 22:00:00',
        ]);
        factory(Author::class)->create([
            'author_id' => 140,
            'author_name' => 'qiita_user_2',
            'count' => 150,
            'created_at' => '2020-11-11 21:00:00',
            'updated_at' => '2020-12-10 22:00:00',
        ]);
        factory(Author::class)->create([
            'author_id' => 121,
            'author_name' => 'qiita_user_3',
            'count' => 800,
            'created_at' => '2020-12-23 21:00:00',
            'updated_at' => '2020-12-25 22:30:00',
        ]);
    }
}
