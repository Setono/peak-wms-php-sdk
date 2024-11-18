<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Request\Query;

final class KeySetPageQuery extends Query
{
    /**
     * @param int|null $lastId The last id from the previous page
     * @param int $pageSize The maximum page size is 250
     */
    public static function create(int $lastId = null, int $pageSize = 250): self
    {
        return new self(array_filter([
            'LastId' => $lastId,
            'PageSize' => $pageSize,
        ]));
    }

    public function setLastId(int $lastId): self
    {
        $this->parameters['LastId'] = $lastId;

        return $this;
    }
}
