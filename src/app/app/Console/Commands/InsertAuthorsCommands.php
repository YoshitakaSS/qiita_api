<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Repositories\V1\Interfaces\AuthorInterface;
use Exception;

class InsertAuthorsCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insertAuthors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert authors json To Authors Table';

    protected $authorRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AuthorInterface $authorRepository)
    {
        parent::__construct();
        $this->authorRepository = $authorRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $starttime = microtime(true);

        $today = date('Y-m-d');

        $this->info('process: start');

        // 教諭フォルダにあるJSONを取得する
        $authorJson = file_get_contents("/mnt/json/author/$today.json");
        $authosList = json_decode($authorJson, true);

        try {
            foreach ($authosList as $author) {
                // 既にデータがあるのか確認する
                $res = $this->authorRepository->getAuthorByName($author);

                if (is_null($res)) {
                    $this->authorRepository->storeAuthors($author);
                } else {
                    $this->authorRepository->updateAuthors($author, $res->count);
                }

            }
        } catch (Exception $e) {
            $this->info(sprintf('process: %s error: %s', 'error', $e));
        } finally {
            $endtime = microtime(true) - $starttime;
            $this->info(sprintf('process: %s, processTime: %s', 'end', $endtime));
        }
    }
}
