<?php

declare(strict_types=1);

namespace App\Service;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

/**
 * Class MitreService
 * @package App\Service
 */
class MitreService
{

    public const SERVICE_NAME = 'https://raw.githubusercontent.com/mitre/cti/master/enterprise-attack/enterprise-attack.json';
    public const EX_TIME = 3600;

    /**
     * get data from the mitre repository
     * @return mixed
     */
    public function getContent()
    {
        if (! Redis::get('enterprise:attack')) {
            $response = Http::get(self::SERVICE_NAME);
            if ($response->ok()) {
                Redis::set('enterprise:attack', $response->body(), 'EX', self::EX_TIME);
            }
        }

        return json_decode(Redis::get('enterprise:attack'));
    }
}
