<?php

namespace Tests\Unit;

use App\Repositories\V1\Eloquent\Models\Author;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    private $author;

    public function setUp():void
    {
        parent::setUp();
    }

    public function testAuthorCommand()
    {
        // Artisan::call('insertAuthors');
        $today = date('Y-m-d');
        $authorJson = file_get_contents("/mnt/json/author/$today.json");
        $authorList = json_decode($authorJson, true);

        // Modelを使用してデータが入ったのか確認する
    }
}
