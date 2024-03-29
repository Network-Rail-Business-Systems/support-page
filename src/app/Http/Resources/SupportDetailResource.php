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
            'editLink' => SupportDetail::editFormRoute($this->resource),
            'deleteLink' => route('support-page.admin.delete', $this->id),
        ];
    }
}
