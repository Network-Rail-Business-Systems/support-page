<?php

namespace NetworkRailBusinessSystems\SupportPage\Tests\Models;

use AnthonyEdmonds\LaravelFind\Findable;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Lab404\Impersonate\Models\Impersonate;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;
use LdapRecord\Laravel\Auth\LdapAuthenticatable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property string $name
 * @property Collection|null $roles
 */
class User extends Authenticatable
{
    use HasFactory;
    use HasRoles;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'email', 'username'];

    protected $guarded = [
        'created_at',
        'deleted_at',
        'id',
        'name',
        'password',
        'remember_token',
        'updated_at',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'id' => 'int',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected string $guard_name = 'web';

    protected $perPage = 10;

    // Setup
    protected static function booted()
    {
        parent::booted();

        static::addGlobalScope('orderByName', function (Builder $query) {
            $query->orderBy('name');
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->dontSubmitEmptyLogs()
            ->logOnlyDirty()
            ->logFillable();
    }

    // Getters
    public function getActiveAttribute(): bool
    {
        return $this->trashed() === false;
    }

    public function getNameAttribute(): string
    {
        return $this->attributes['name'] ?? "{$this->first_name} {$this->last_name}";
    }

    public function getShortEmailAttribute(): string
    {
        return explode('@', $this->email, 2)[0];
    }

    // Setters
    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = Hash::make($password);
    }

    // Scopes
    public function scopeByEmail(Builder $query, string $email): Builder
    {
        return $query->where('email', '=', $email);
    }

    public function scopeByName(Builder $query, string $name): Builder
    {
        return $query->where(function ($query) use ($name) {
            $query
                ->where('name', '=', $name)
                ->orWhere('first_name', 'like', "$name%")
                ->orWhere('last_name', 'like', "$name%");
        });
    }

    public function scopeByUsername(Builder $query, string $name): Builder
    {
        return $query->where('username', '=', $name);
    }

    public function scopeHasRoles(Builder $query): Builder
    {
        return $query->whereHas('roles');
    }

    public function scopeByRole(Builder $query, string $role, string $column = 'name'): Builder
    {
        return $query->whereHas('roles', function (Builder $query) use ($role, $column) {
            $query->where($column, '=', $role);
        });
    }

    // Utilities
    public function canImpersonate(): bool
    {
        return $this->hasPermissionTo('impersonate_users') === true;
    }

    public function canBeImpersonated(): bool
    {
        return $this->hasPermissionTo('impersonate_users') !== true;
    }

    // Laravel Find
    public static function findTypeLabel(): string
    {
        return 'Users by name, e-mail, or Role';
    }

    /**
     * @param  User|null  $user
     */
    public static function canBeFoundBy(?Model $user): bool
    {
        return $user->can('find_users');
    }

    protected static function findLabel(): string
    {
        return 'users.name';
    }

    protected static function findDescription(): string
    {
        return 'users.email';
    }

    protected static function findLink(): string
    {
        return route('users.show', '~users.id');
    }

    protected static function findFilters(
        QueryBuilder $query,
        string $term,
        Model $user = null,
    ): QueryBuilder {
        return $query
            ->leftJoin('user_has_roles', 'user_has_roles.user_id', '=', 'users.id')
            ->leftJoin('roles', 'roles.id', '=', 'user_has_roles.role_id')
            ->where('users.name', 'like', "%{$term}%")
            ->orWhere('users.email', 'like', "%{$term}%")
            ->orWhere('roles.name', 'like', "%{$term}%")
            ->groupBy('users.id');
    }
}
