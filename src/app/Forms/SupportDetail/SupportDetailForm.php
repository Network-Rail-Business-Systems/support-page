<?php

namespace NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\LabelQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TargetQuestion;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;

class SupportDetailForm extends Form
{
    public static function key(): string
    {
        return 'support-detail';
    }

    /**
     * @throws AuthorizationException
     */
    public function checkAccess(Model $subject): void
    {
        $permission = config('support-page.permission');

        if ($permission !== null) {
            $this->authorize($permission);
        }
    }

    public function questions(): array
    {
        return [
            TypeQuestion::class,
            LabelQuestion::class,
            TargetQuestion::class,
        ];
    }

    protected function makeNewSubject(): Model
    {
        return new SupportDetail();
    }

    /** @param  SupportDetail  $subject */
    protected function submitForm(Model $subject, string $mode): void
    {
        if ($subject->target === null) {
            flash()->error("$subject->targetLabel cannot be blank.");
            abort(redirect()->back());
        } else {
            $subject->save();

            $mode === Form::NEW
                ? flash()->success("Support detail $subject->id created")
                : flash()->success("Support detail $subject->id updated");
        }
    }

    public function exitRoute(?Model $subject = null): string
    {
        return route('support-page.admin.index');
    }
}
