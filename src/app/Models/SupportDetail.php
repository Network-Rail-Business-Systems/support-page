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
 * @property ?string $email
 * @property int $id
 * @property string $label
 * @property string $link
 * @property ?string $role
 * @property string $suffix
 * @property ?string $target
 * @property string $type
 * @property Carbon $updated_at
 * @property ?string $url
 */
class SupportDetail extends Model implements UsesForm
{
    use HasFactory;
    use HasForm;

    protected $fillable = [
        'email',
        'label',
        'role',
        'type',
        'url',
    ];

    protected $guarded = [
        'created_at',
        'id',
        'target',
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
        if ($this->type = TypeQuestion::SYSTEM_QUESTIONS) {
            if ($this->target === null) {
                return 'You must select a target';
            }

            if (
                $this->target === 'email'
                && $this->email === null
            ) {
                return 'You must provide an e-mail address';
            }

            if (
                $this->target === 'role'
                && $this->role === null
            ) {
                return 'You must select a system role';
            }
        } else {
            if ($this->url === null) {
                return 'Provide a valid URL';
            }
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

    // Getters
    public function getLinkAttribute(): string
    {
        if ($this->type === TypeQuestion::SYSTEM_QUESTIONS) {
            return $this->target === 'email'
                ? "mailto:$this->email?subject={$this::getEnquirySubject()}"
                : route('support-page.owners', [$this->role]);
        } else {
            return $this->url;
        }
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
}
