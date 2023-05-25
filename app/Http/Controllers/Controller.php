<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Redis;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function setRedis($json, $key)
    {
        $redis = new \Redis();
        try {
            $redis->connect($_ENV['REDIS_HOST'], $_ENV['REDIS_PORT']);
        } catch (\Exception $e) {
            return false;
        }

        $redis->set($key, $json);

        return true;
    }

    public function getRedis($key)
    {
        $redis = new \Redis();
        try {
            $redis->connect($_ENV['REDIS_HOST'], $_ENV['REDIS_PORT']);
        } catch (\Exception $e) {
            return false;
        }

        return $redis->get($key);
    }


}
