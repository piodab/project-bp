<?php

namespace App\Http\Controllers;

use App\Service\TacticService;
use App\Service\TechniquesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

/**
 * Class TacticController
 * @package App\Http\Controllers
 */
class TacticController extends Controller
{
    /**
     * Return all tactics
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $tacticService = new TacticService();
        $tactics = $tacticService->getTactics();

        return view('tactics.index', compact('tactics'));
    }

    /**
     * Returns the selected tactic
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Request $request, $id)
    {
        $tacticService = new TacticService();
        $tactics = collect($tacticService->getTactics());

        $findTactic = $tactics->where('external_id', $id)->first();
        $shortName = $findTactic->shortname;

        $techniquesService = new TechniquesService();
        $techniques = collect($techniquesService->findTechniques($request->search, $shortName));
        $techniques = $techniques->sortBy('external_id');

        return view('tactics.show', compact('tactics', 'techniques'));
    }
}
