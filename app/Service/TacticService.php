<?php

declare(strict_types=1);

namespace App\Service;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

/**
 * Class TacticService
 * @package App\Service
 */
class TacticService
{
    public const EX_TIME = 86400;
    public const KEY_TACTICS = 'tactics:enterprise';

    /**
     * Returns a list of tactics from api or redis
     * @return mixed
     */
    public function getTactics()
    {
        if (!Cache::has(self::KEY_TACTICS)) {
            $response = Http::get(url('/api/v1/tactics'));
            if ($response->ok()) {
                Cache::put(self::KEY_TACTICS, $response->body(), self::EX_TIME);
            }
        }

        return json_decode(Cache::get(self::KEY_TACTICS))->data;
    }
}
