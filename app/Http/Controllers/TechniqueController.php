<?php

namespace App\Http\Controllers;

use App\Service\TechniquesService;

class TechniqueController extends Controller
{
    /**
     * Show single technique
     * @param $id
     * @param null $subId
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id, $subId = null)
    {
        $techniquesService = new TechniquesService();
        $technique = $techniquesService->showTechnique($id, $subId);
        $techniques = collect($techniquesService->getTechniques());
        $techniques = $techniques->sortBy('phase_name');

        $groupedTechniques = [];
        foreach ($techniques  as $tech) {
            $groupedTechniques[$tech->phase_name][] = $tech;
        }

        return view('techniques.show', compact('technique', 'groupedTechniques'));
    }

}
