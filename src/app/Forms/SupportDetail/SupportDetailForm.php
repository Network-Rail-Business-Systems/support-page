<?php

namespace NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
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

    public function checkAccess(): void
    {
        //
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

    // change param model to be config('support-page.support_detail_model')?

    /** @param  SupportDetail  $subject */
    protected function submitForm(Model $subject, string $mode): void
    {
        if ($subject->target === null) {
            flash()->error("$subject->targetLabel cannot be blank.");
            abort(redirect()->back());
        } else {
            $subject->save();
        }
    }

    public function confirmationBlade(): string
    {
        return 'support-page::support.confirmation';
    }

    public function exitRoute(Model $subject = null): string
    {
        return route('support-details.index');
    }
}
