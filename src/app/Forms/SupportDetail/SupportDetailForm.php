<?php

namespace NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail;

use AnthonyEdmonds\LaravelFormBuilder\Items\Form;
use AnthonyEdmonds\LaravelFormBuilder\Items\Tasks;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;

/** @property SupportDetail $model */
class SupportDetailForm extends Form
{
    public static function key(): string
    {
        return 'support-detail';
    }

    public function checkAccess(): static
    {
        $permission = config('support-page.permission');

        if ($permission !== null) {
            $this->authorize($permission);
        }

        return $this;
    }

    public function tasks(): Tasks
    {
        return new SupportDetailTasks($this);
    }

    public static function modelClass(): string
    {
        return SupportDetail::class;
    }

    public function exitRoute(): string
    {
        return route('support-page.admin.index');
    }

    public function startIsEnabled(): bool
    {
        return false;
    }

    public function confirmationIsEnabled(): bool
    {
        return false;
    }
}
