<?php

declare(strict_types=1);

namespace App\Service;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

/**
 * Class MitreService
 * @package App\Service
 */
class MitreService
{
    public const SERVICE_NAME = 'https://raw.githubusercontent.com/mitre/cti/master/enterprise-attack/enterprise-attack.json';
    public const EX_TIME = 3600;
    public const KEY_MITRE = 'enterprise:attack';

    /**
     * get data from the mitre repository
     * @return mixed
     */
    public function getContent()
    {
        if (!Cache::has(self::KEY_MITRE)) {
            $response = Http::get(self::SERVICE_NAME);
            if ($response->ok()) {
                Cache::put(self::KEY_MITRE, $response->body(), self::EX_TIME);
            }
        }

        return json_decode(Cache::get(self::KEY_MITRE));
    }
}
