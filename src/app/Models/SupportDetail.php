<?php

namespace NetworkRailBusinessSystems\SupportPage\Models;

use AnthonyEdmonds\GovukLaravel\Traits\HasForm;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\LabelQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TargetQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\SupportDetailForm;
use Spatie\Permission\Models\Role;

/**
 * @property string $targetLabel
 * @property string $type
 * @property string|null $target
 * @property string $label
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class SupportDetail extends Model
{
    use HasForm;

    protected $fillable = ['type', 'target', 'label'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function formClass(): string
    {
        return SupportDetailForm::class;
    }

    public static function getEnquirySubject(): string
    {
        return 'Enquiry about '.config('app.name');
    }

    public function getType(): string
    {
        return $this->type === TypeQuestion::SYSTEM_QUESTIONS
            ?
            '(draft a new e-mail)'
            :
            '(opens in a new tab)';
    }

    public function getTarget(): string
    {
        if ($this->type === TypeQuestion::SYSTEM_QUESTIONS) {
            if (str_contains($this->target, '@') === true) {
                return "mailto:{$this->target}?subject={$this::getEnquirySubject()}";
            } else {
                return route('support.owners', [$this->target]);
            }
        } else {
            return $this->target;
        }
    }

    public function getTargetLabelAttribute(): string
    {
        if ($this->type === TypeQuestion::SYSTEM_QUESTIONS) {
            return str_contains($this->target, '@') === true
                ? 'E-mail'
                : 'Role';
        } else {
            return 'URL';
        }
    }

    public function toSummary(bool $showChange = false): array
    {
        $targetKey = $this->targetLabel;

        $targetKey === 'Role' && $this->target !== null
           ? $targetValue = Role::find($this->target)->name
           : $targetValue = $this->target;

        return [
            'Type' => $this->makeSummaryItem(
                TypeQuestion::key(),
                'Type',
                $this->type,
                $showChange
            ),
            'Label' => $this->makeSummaryItem(
                LabelQuestion::key(),
                'Label',
                $this->label,
                $showChange
            ),
            $targetKey => $this->makeSummaryItem(
                TargetQuestion::key(),
                $targetKey,
                $targetValue,
                $showChange
            ),
        ];
    }
}
