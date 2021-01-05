<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Technique;
use Illuminate\Http\Request;

/**
 * Class TechniqueController
 * @package App\Http\Controllers\Api
 */
class TechniqueController extends Controller
{
    /**
     * Returns techniques with the option to search and filter data
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->isMethod('get')) {
            $phaseName = $request->pname;
            $search = $request->search;

            $techniques = Technique::when(
                $search,
                function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                }
            )
                ->when(
                    $phaseName,
                    function ($q) use ($phaseName) {
                        $q->where('phase_name', $phaseName);
                    }
                )
                ->get();
        } else {
            $techniques = Technique::all();
        }

        $response = [
            'data' => $techniques,
        ];

        return response()->json($response, 200);
    }

    /**
     * Return selected Technique
     * @param $id
     * @param $subId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id, $subId)
    {
        $techniqueId =  ('000' == $subId) ? $id : "$id.$subId";

        $technique = Technique::where('external_id', $techniqueId)->firstOrFail();

        $response = [
            'data' => $technique,
        ];

        return response()->json($response, 200);
    }
}
