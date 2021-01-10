<?php

declare(strict_types=1);

namespace App\Support\Mitre\Content;

/**
 * Interface Content
 * @package App\Support\Mitre\Content
 */
interface Content
{
    /**
     * Updatee content
     */
    public function update(): void;

    /**
     * Prepare the data to the format of the data stored in the database
     */
    public function prepareData();

    /**
     * @param $content
     * @return mixed
     */
    public function setContent($content);

}
