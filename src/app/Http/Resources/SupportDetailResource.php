<?php

namespace App\Http\Resources;

use App\Models\SupportDetail;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'deleteLink' => route('support-details.delete', $this->id),
        ];
    }
}