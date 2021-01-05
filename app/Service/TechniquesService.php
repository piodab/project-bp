<?php

declare(strict_types=1);

namespace App\Service;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

/**
 * Class TechniquesService
 * @package App\Service
 */
class TechniquesService
{
    public const EX_TIME = 86400;
    public const KEY_TECHNIQUES = 'techniques:enterprise';

    /**
     * Returns a list of techniques from api or redis
     * @return mixed
     */
    public function getTechniques()
    {
        if (!Redis::get(self::KEY_TECHNIQUES)) {
            $response = Http::get(config('app.url') . '/api/v1/techniques');
            if ($response->ok()) {
                Redis::set(self::KEY_TECHNIQUES, $response->body(), 'EX', self::EX_TIME);
            }
        }

        return json_decode(Redis::get('techniques:enterprise'))->data;
    }

    /**
     * Find techniques from api or redis
     * @param null $search
     * @param null $shortName
     * @return mixed
     */
    public function findTechniques($search = null, $shortName = null)
    {
        if (!Redis::get('techniques:enterprise#search:' . $search . '#short.name:' . $shortName)) {
            $response = Http::get(
                config('app.url') . '/api/v1/techniques',
                [
                    'search' => $search,
                    'pname' => $shortName,
                ]
            );
            if ($response->ok()) {
                Redis::set(
                    'techniques:enterprise#search:' . $search . '#short.name:' . $shortName,
                    $response->body(),
                    'EX',
                    self::EX_TIME
                );
            }
        }

        return json_decode(Redis::get('techniques:enterprise#search:' . $search . '#short.name:' . $shortName))->data;
    }

    /**
     * Show single technique
     * @param $id
     * @param null $subId
     * @return mixed
     */
    public function showTechnique($id, $subId = null)
    {
        $subId ??= '000';

        if (!Redis::get('technique:' . $id . ':' . $subId)) {
            $response = Http::get(config('app.url') . '/api/v1/techniques/' . $id . '/' . $subId);
            if ($response->ok()) {
                Redis::set('technique:' . $id . ':' . $subId, $response->body(), 'EX', self::EX_TIME);
            }
        }

        return json_decode(Redis::get('technique:' . $id . ':' . $subId))->data;
    }

}
