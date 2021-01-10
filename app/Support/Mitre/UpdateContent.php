<?php

declare(strict_types=1);

namespace App\Support\Mitre;

use App\Service\MitreService;
use App\Support\Mitre\Content\Content;
use Illuminate\Support\Collection;

/**
 * Class UpdateContent
 * @package App\Support\Mitre
 */
class UpdateContent
{
    private $contents;
    private $mitreService;

    /**
     * UpdateContent constructor.
     * @param MitreService $mitreService
     */
    public function __construct(MitreService $mitreService)
    {
        $this->mitreService = $mitreService;
        $this->contents = new Collection();
    }

    /**
     * Add new conntent
     * @param Content $content
     * @return $this
     */
    public function add(Content $content): self
    {
        $content->setContent($this->mitreService->getContent()->objects);
        $this->contents->push($content);

        return $this;
    }

    /**
     * Update Content
     */
    public function updateContent(): void
    {
        $this->contents->each(
            function ($item) {
                $item->update();
            }
        );

    }
}
