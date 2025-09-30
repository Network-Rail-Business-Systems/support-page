<?php

namespace NetworkRailBusinessSystems\SupportPage\Models;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesForm;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasForm;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NetworkRailBusinessSystems\SupportPage\Database\Factories\SupportDetailFactory;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;

/**
 * @property Carbon $created_at
 * @property int $id
 * @property string $label
 * @property string|null $target
 * @property string $target_label
 * @property string $type
 * @property Carbon $updated_at
 */
class SupportDetail extends Model implements UsesForm
{
    use HasFactory;
    use HasForm;

    protected $fillable = ['type', 'target', 'label'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // UsesForm
    public function viewRoute(): string
    {
        return route('support-page.admin.index');
    }

    // TODO May not be needed anymore
    public function submitIsValid(): true|string
    {
        if ($this->target === null) {
            return "$this->target_label cannot be blank.";
        }

        return true;
    }

    public function saveAndSubmit(): void
    {
        $this->save();

        $this->wasRecentlyCreated === true
            ? flash()->success("Support detail #$this->id created")
            : flash()->success("Support detail #$this->id updated");
    }

    // Utilities
    public static function getEnquirySubject(): string
    {
        return 'Enquiry about ' . rawurlencode(config('app.name'));
    }

    public function getType(): string
    {
        return $this->type === TypeQuestion::SYSTEM_QUESTIONS
            ? '(draft a new e-mail)'
            : '(opens in a new tab)';
    }

    public function getTarget(): string
    {
        if ($this->type === TypeQuestion::SYSTEM_QUESTIONS) {
            if ($this->targetIsEmail() === true) {
                return "mailto:$this->target?subject={$this::getEnquirySubject()}";
            } else {
                return route('support-page.owners', [$this->target]);
            }
        } else {
            return $this->target;
        }
    }

    public function getTargetLabelAttribute(): string
    {
        if ($this->type === TypeQuestion::SYSTEM_QUESTIONS) {
            return $this->targetIsEmail() === true
                ? 'E-mail'
                : 'Role';
        } else {
            return 'URL';
        }
    }

    public function targetIsEmail(): bool
    {
        return str_contains($this->target, '@') === true;
    }

    protected static function newFactory(): SupportDetailFactory
    {
        return new SupportDetailFactory();
    }
}
