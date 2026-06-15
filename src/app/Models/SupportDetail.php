<?php

namespace NetworkRailBusinessSystems\SupportPage\Models;

use AnthonyEdmonds\LaravelFormBuilder\Interfaces\UsesForm;
use AnthonyEdmonds\LaravelFormBuilder\Traits\HasForm;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\RouteCollection;
use Illuminate\Support\Facades\Route;
use NetworkRailBusinessSystems\SupportPage\Database\Factories\SupportDetailFactory;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

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
        return route(SupportDetail::routeName('index'));
    }

    public function submitIsValid(): true|string
    {
        if ($this->target === null) {
            return 'You must provide a target for this support detail';
        }

        return $this->tasksAreComplete();
    }

    public function saveAndSubmit(): void
    {
        $this->save();

        $this->wasRecentlyCreated === true
            ? flash()->success("Support detail #$this->id created")
            : flash()->success("Support detail #$this->id updated");
    }

    public function draftIsEnabled(): bool
    {
        return false;
    }

    // Getters
    public function getLinkAttribute(): string
    {
        if ($this->type === TypeQuestion::SYSTEM_QUESTIONS) {
            return $this->targetIsEmail() === true
                ? "mailto:$this->target?subject={$this::getEnquirySubject()}"
                : route(SupportDetail::routeName('owners'), $this->target);
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

    public static function routeName(string $endpoint): string
    {
        /** @var RouteCollection $routes */
        $routes = Route::getRoutes();

        foreach ($routes as $route) {
            $name = $route->getName();

            if (str_ends_with($name, "support-page.$endpoint") === true) {
                return $name;
            }
        }

        throw new RouteNotFoundException("The Support Page \"$endpoint\" route has not been registered");
    }

    public function targetIsEmail(): bool
    {
        return str_contains($this->target, '@') === true;
    }
}
