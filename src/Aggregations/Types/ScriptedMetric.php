<?php

namespace Codeart\OpensearchLaravel\Aggregations\Types;

use Codeart\OpensearchLaravel\Interfaces\OpenSearchQuery;

class ScriptedMetric implements OpenSearchQuery, AggregationType
{
    public function __construct(
        private readonly string $mapScript,
        private readonly string $combineScript,
        private readonly string $reduceScript,
        private readonly ?string $initScript = null,
    ){}

    public static function make(string $mapScript, string $combineScript, string $reduceScript, ?string $initScript = null): self
    {
        return new self($mapScript, $combineScript, $reduceScript, $initScript);
    }

    public function toOpenSearchQuery(): array
    {
        $query = [
            'scripted_metric' => [
                'map_script' => $this->mapScript,
                'combine_script' => $this->combineScript,
                'reduce_script' => $this->reduceScript,
            ]
        ];

        if (!is_null($this->initScript)) {
            $query['scripted_metric']['init_script'] = $this->initScript;
        }

        return $query;
    }
}