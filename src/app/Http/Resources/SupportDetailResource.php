<?php

namespace NetworkRailBusinessSystems\SupportPage\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;

/**
 * @mixin SupportDetail
 */
class SupportDetailResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => $this->type,
            'target' => $this->target,
            'label' => $this->label,
            'editLink' => config('support-page.support_detail_model')::editFormRoute($this->resource),
            'deleteLink' => route('support-details.delete', $this->id),
        ];
    }
}
