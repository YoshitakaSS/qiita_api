<?php

namespace App\Repositories\V1\Cache;

use Illuminate\Support\Facades\Redis;

class Cache
{
    /**
     * キャッシュされたデータを取得する
     *
     * @param  mixed $class
     * @param  mixed $method
     * @param  mixed $key
     * @return void
     */
    public static function getValue($class, $method, $key)
    {
       return json_decode(Redis::get(self::createKey($class, $method, $key)));
    }

    /**
     * データをキャッシュする
     *
     * @param  mixed $class
     * @param  mixed $method
     * @param  mixed $keys
     * @param  mixed $values
     * @param  mixed $expire
     * @return void
     */
    public static function setValue($class, $method, array $keys, $values, int $expire = 600)
    {
        $key = self::createKey($class, $method, $keys);
        Redis::set($key, json_encode($values));
        Redis::expire($key, $expire);
    }

    /**
     * キャッシュキーを作る
     * @param $class
     * @param $method
     * @param $keys
     * @return string
     */
    private static function createKey($class, $method, $keys)
    {
        return "{$class}-{$method}-" . json_encode($keys);
    }
}
