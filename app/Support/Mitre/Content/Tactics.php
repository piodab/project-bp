<?php

declare(strict_types=1);

namespace App\Support\Mitre\Content;

use App\Models\Tactic;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Class Tactics
 * @package App\Support\Mitre\Content
 */
class Tactics implements Content
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
        $lastModification = Tactic::orderBy('updated_at', 'desc')->first();
        $lastModificationDate = ($lastModification)
            ? $lastModification->created_at->toDateTimeString()
            : false;

        $techniques = $this->prepareData();

        if ($lastModificationDate) {
            //update
            $techniques = $techniques->where('modified', '>', $lastModificationDate);
            $techniquesExternalId = $techniques->pluck('external_id');
            Tactic::whereIn('mitre_id', $techniquesExternalId)->delete();
            Tactic::insert($techniques->toArray());
        } else {
            //first insert
            Tactic::insert($techniques->toArray());
        }
    }

    /**
     * Prepare the data to the format of the data stored in the database
     */
    public function prepareData()
    {
        $contents = $this->content;

        $tactics = new Collection();

        foreach ($contents as $content) {
            if ('x-mitre-tactic' === $content->type) {
                $this->tacticList[$content->x_mitre_shortname] = $content->x_mitre_shortname;

                $tactic = [
                    "name" => $content->name,
                    "shortname" => $content->x_mitre_shortname,
                    "description" => $content->description,
                    "mitre_id" => $content->id,
                    "modified" => Carbon::parse($content->modified)->toDateTimeString(),
                    "created" => Carbon::parse($content->created)->toDateTimeString(),
                    "external_id" => $content->external_references[0]->external_id,
                    "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
                    "updated_at" => Carbon::now()->format('Y-m-d H:i:s'),
                ];

                $tactics->push(collect($tactic));
            }
        }

        return $tactics;
    }
}
