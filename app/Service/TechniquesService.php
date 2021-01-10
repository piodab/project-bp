<?php

declare(strict_types=1);

namespace App\Service;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

/**
 * Class TechniquesService
 * @package App\Service
 */
class TechniquesService
{
    public const EX_TIME = 86400;
    //Redis keys
    public const KEY_TECHNIQUES = 'techniques:enterprise';
    public const KEY_TECHNIQUES_SEARCH = 'techniques:enterprise#search:';
    public const KEY_SHORT_NAME = '#short.name:';

    /**
     * Returns a list of techniques from api or redis
     * @return mixed
     */
    public function getTechniques()
    {
        if (!Cache::has(self::KEY_TECHNIQUES)) {
            $response = Http::get(config('app.url') . '/api/v1/techniques');
            if ($response->ok()) {
                Cache::put(self::KEY_TECHNIQUES, $response->body(), self::EX_TIME);
            }
        }

        return json_decode(Cache::get(self::KEY_TECHNIQUES))->data;
    }

    /**
     * Find techniques from api or redis
     * @param null $search
     * @param null $shortName
     * @return mixed
     */
    public function findTechniques($search = null, $shortName = null)
    {
        if (!Cache::has(self::KEY_TECHNIQUES_SEARCH . $search . self::KEY_SHORT_NAME . $shortName)) {
            $response = Http::get(
                url('/api/v1/techniques'),
                [
                    'search' => $search,
                    'pname' => $shortName,
                ]
            );
            if ($response->ok()) {
                Cache::put(
                    self::KEY_TECHNIQUES_SEARCH . $search . self::KEY_SHORT_NAME . $shortName,
                    $response->body(),
                    self::EX_TIME
                );
            }
        }

        return json_decode(Cache::get(self::KEY_TECHNIQUES_SEARCH . $search . self::KEY_SHORT_NAME . $shortName))->data;
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

        if (!Cache::has('technique:' . $id . ':' . $subId)) {
            $response = Http::get(url( '/api/v1/techniques/' . $id . '/' . $subId));
            if ($response->ok()) {
                Cache::put('technique:' . $id . ':' . $subId, $response->body(), self::EX_TIME);
            }
        }

        return json_decode(Cache::get('technique:' . $id . ':' . $subId))->data;
    }

}
