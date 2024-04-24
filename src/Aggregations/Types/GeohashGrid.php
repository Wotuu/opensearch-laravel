<?php

namespace Codeart\OpensearchLaravel\Aggregations\Types;

use Codeart\OpensearchLaravel\Interfaces\OpenSearchQuery;

class GeohashGrid implements OpenSearchQuery, AggregationType
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
            'geohash_grid' => [
                'field' => $this->field,
            ]
        ];

        if(!is_null($this->precision)) {
            $query['geohash_grid']['precision'] = $this->precision;
        }

        if(!is_null($this->size)) {
            $query['geohash_grid']['size'] = $this->size;
        }

        if(!is_null($this->shardSize)) {
            $query['geohash_grid']['shard_size'] = $this->shardSize;
        }

        return $query;
    }
}