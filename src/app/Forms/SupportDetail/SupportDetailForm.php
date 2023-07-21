<?php

namespace Networkrailbusinesssystems\SupportPage\Forms\SupportDetail;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use Illuminate\Database\Eloquent\Model;
use Networkrailbusinesssystems\SupportPage\Forms\SupportDetail\Questions\LabelQuestion;
use Networkrailbusinesssystems\SupportPage\Forms\SupportDetail\Questions\TargetQuestion;
use Networkrailbusinesssystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use Networkrailbusinesssystems\SupportPage\Models\SupportDetail;

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
        return 'support.confirmation';
    }

    public function exitRoute(Model $subject = null): string
    {
        return route('support-details.create');
    }
}
