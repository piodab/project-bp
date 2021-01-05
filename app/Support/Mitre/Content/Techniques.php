<?php

declare(strict_types=1);

namespace App\Support\Mitre\Content;

use App\Models\Technique;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Class Techniques
 * @package App\Support\Mitre\Content
 */
class Techniques implements Content
{
    private $content;

    /**
     * @param $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Updatee content
     */
    public function update(): void
    {
        $lastModification = Technique::orderBy('updated_at', 'desc')->first();
        $lastModificationDate = ($lastModification)
            ? $lastModification->created_at->toDateTimeString()
            : false;

        $techniques = $this->prepareData();

        if ($lastModificationDate) {
            //update
            $techniques = $techniques->where('modified', '>', $lastModificationDate);
            $techniquesExternalId = $techniques->pluck('external_id');
            Technique::whereIn('external_id', $techniquesExternalId)->delete();
            Technique::insert($techniques->toArray());

        } else {
            //first insert
            Technique::insert($techniques->toArray());
        }
    }

    /**
     * Prepare the data to the format of the data stored in the database
     * @return Collection
     */
    public function prepareData()
    {
        $contents = $this->content;
        $techniques = new Collection();

        foreach ($contents as $content) {
            if (isset($content->kill_chain_phases[0]->phase_name)) {
                $technique = [
                    'name' => $content->name,
                    'description' => $content->description,
                    'detection' => $content->x_mitre_detection,
                    'phase_name' => $content->kill_chain_phases[0]->phase_name,
                    'external_id' => $content->external_references[0]->external_id,
                    'modified' => Carbon::parse($content->modified)->toDateTimeString(),
                    'created' => Carbon::parse($content->created)->toDateTimeString(),
                    "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
                    "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
                ];

                $techniques->push(collect($technique));
            }
        }

        return $techniques;
    }
}
