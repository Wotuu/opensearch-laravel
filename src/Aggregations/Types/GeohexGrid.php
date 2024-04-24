<?php

namespace Codeart\OpensearchLaravel\Aggregations\Types;

use Codeart\OpensearchLaravel\Interfaces\OpenSearchQuery;

class GeohexGrid implements OpenSearchQuery, AggregationType
{
    public function __construct(
        private readonly string $field,
        private readonly ?int $precision = null,
        private readonly ?int $size = null,
        private readonly ?int $shardSize = null,
    ){}

    public static function make(string $field, ?int $precision = null, ?int $size = null, ?int $shardSize = null): self
    {
        return new self($field, $precision, $size, $shardSize);
    }

    public function toOpenSearchQuery(): array
    {
        $query = [
            'geohex_grid' => [
                'field' => $this->field,
            ]
        ];

        if(!is_null($this->precision)) {
            $query['geohex_grid']['precision'] = $this->precision;
        }

        if(!is_null($this->size)) {
            $query['geohex_grid']['size'] = $this->size;
        }

        if(!is_null($this->shardSize)) {
            $query['geohex_grid']['shard_size'] = $this->shardSize;
        }

        return $query;
    }
}