<?php

namespace App\Forms\SupportDetail;

use AnthonyEdmonds\GovukLaravel\Forms\Form;
use App\Forms\SupportDetail\Questions\LabelQuestion;
use App\Forms\SupportDetail\Questions\TargetQuestion;
use App\Forms\SupportDetail\Questions\TypeQuestion;
use App\Models\SupportDetail;
use Illuminate\Database\Eloquent\Model;

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

    public function exitRoute(Model|null $subject = null): string
    {
        return route('support-details.create');
    }
}
