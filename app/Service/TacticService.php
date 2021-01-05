<?php

declare(strict_types=1);

namespace App\Service;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

/**
 * Class TacticService
 * @package App\Service
 */
class TacticService
{
    public const EX_TIME = 86400;

    /**
     * Returns a list of tactics from api or redis
     * @return mixed
     */
    public function getTactics()
    {
        if (! Redis::get('tactics:enterprise')) {
            $response = Http::get(config('app.url').'/api/v1/tactics');
            if ($response->ok()) {
                Redis::set('tactics:enterprise', $response->body(), 'EX', self::EX_TIME);
            }
        }

        return json_decode(Redis::get('tactics:enterprise'))->data;
    }
}
