<?php

namespace Codeart\OpensearchLaravel\Aggregations\Types;

use Codeart\OpensearchLaravel\Interfaces\OpenSearchQuery;

class Composite implements OpenSearchQuery, AggregationType
{
    /**
     * @param OpenSearchQuery[] $sources
     * @param int $size
     */
    public function __construct(
        private readonly array $sources,
        private readonly int   $size,
    ) {}

    public static function make(array $sources, int $size): self
    {
        return new self($sources, $size);
    }

    public function toOpenSearchQuery(): array
    {
        $sources = [];

        foreach ($this->sources as $key => $source) {
            $sources[] = [
                $key => $source->toOpenSearchQuery()
            ];
        }

        return [
            'composite' => [
                'size' => $this->size,
                'sources' => $sources
            ]
        ];
    }
}