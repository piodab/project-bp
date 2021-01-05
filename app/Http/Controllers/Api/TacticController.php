<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tactic;

/**
 * Class TacticController
 * @package App\Http\Controllers\Api
 */
class TacticController extends Controller
{
    /**
     * Return all tactics
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tactics = Tactic::all();

        $response = [
            'data' => $tactics,
        ];

        return response()->json($response, 200);
    }
}
