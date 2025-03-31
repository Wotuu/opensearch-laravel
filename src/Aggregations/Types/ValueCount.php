<?php

namespace Codeart\OpensearchLaravel\Aggregations\Types;

use Codeart\OpensearchLaravel\Interfaces\OpenSearchQuery;

class ValueCount implements OpenSearchQuery, AggregationType
{
    public function __construct(
        private readonly string $field,
    ){}

    public static function make(string $field): self
    {
        return new self($field);
    }

    public function toOpenSearchQuery(): array
    {
        return [
            'value_count' => [
                'field' => $this->field,
            ]
        ];
    }
}