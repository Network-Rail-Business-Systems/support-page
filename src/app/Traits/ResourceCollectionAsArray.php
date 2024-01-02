<?php

namespace NetworkRailBusinessSystems\SupportPage\Traits;

use Illuminate\Http\Request;

trait ResourceCollectionAsArray
{
    /**
     * Send an Eloquent ResourceCollection to a blade (or anywhere else really, it's just an array)
     * without having to pass in any request nonsense. Unless you want to. That's your problem.
     *
     * @author Anthony Edmonds
     *
     * @link https://github.com/AnthonyEdmonds
     *
     * @param  Request|null  $request A request object, if you have one
     * @return array A complete array with pagination controls
     */
    public function asArray(?Request $request = null): array
    {
        if ($request === null) {
            $request = request();
        }

        $data = $this->collection->map->toArray($request)->all();
        $resource = $this->resource->toArray();

        return [
            'data' => $data,
            'links' => [
                'first' => $resource['first_page_url'] ?? null,
                'last' => $resource['last_page_url'] ?? null,
                'next' => $resource['next_page_url'] ?? null,
                'prev' => $resource['prev_page_url'] ?? null,
            ],
            'meta' => [
                'current_page' => $resource['current_page'] ?? null,
                'from' => $resource['from'] ?? null,
                'last_page' => $resource['last_page'] ?? null,
                'path' => $resource['path'] ?? null,
                'per_page' => $resource['per_page'] ?? null,
                'to' => $resource['to'] ?? null,
                'total' => $resource['total'] ?? null,
            ],
        ];
    }
}
