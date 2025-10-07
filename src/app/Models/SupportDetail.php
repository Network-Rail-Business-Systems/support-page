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
 * @property string $link
 * @property string $mode
 * @property string $suffix
 * @property ?string $target
 * @property ?string $type
 * @property Carbon $updated_at
 */
class SupportDetail extends Model implements UsesForm
{
    use HasFactory;
    use HasForm;

    protected $fillable = [
        'label',
        'target',
        'type',
    ];

    protected $guarded = [
        'created_at',
        'id',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'id' => 'integer',
        'updated_at' => 'datetime',
    ];

    // Setup
    protected static function newFactory(): SupportDetailFactory
    {
        return new SupportDetailFactory();
    }

    // UsesForm
    public function viewRoute(): string
    {
        return route('support-page.admin.index');
    }

    public function submitIsValid(): true|string
    {
        return $this->target === null
            ? 'You must provide a target for this support detail'
            : true;
    }

    public function saveAndSubmit(): void
    {
        $this->save();

        $this->wasRecentlyCreated === true
            ? flash()->success("Support detail #$this->id created")
            : flash()->success("Support detail #$this->id updated");
    }

    // Getters
    public function getLinkAttribute(): string
    {
        if ($this->type === TypeQuestion::SYSTEM_QUESTIONS) {
            return $this->targetIsEmail() === true
                ? "mailto:$this->target?subject={$this::getEnquirySubject()}"
                : route('support-page.owners', $this->target);
        } else {
            return $this->target;
        }
    }

    public function getModeAttribute(): string
    {
        return match (true) {
            $this->target === null => '',
            $this->targetIsEmail() === true => 'email',
            default => 'role',
        };
    }

    public function getSuffixAttribute(): string
    {
        return $this->type === TypeQuestion::SYSTEM_QUESTIONS
            ? '(draft a new e-mail)'
            : '(opens in a new tab)';
    }

    // Utilities
    public static function getEnquirySubject(): string
    {
        return 'Enquiry about ' . rawurlencode(config('app.name'));
    }

    public function targetIsEmail(): bool
    {
        return str_contains($this->target, '@') === true;
    }
}
