<?php

namespace Networkrailbusinesssystems\SupportPage\Http\Controllers\Support;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Resources\SupportDetailCollection;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Networkrailbusinesssystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use Networkrailbusinesssystems\SupportPage\Models\SupportDetail;

class SupportController extends BaseController
{
    public function support(): View
    {
        $groups = SupportDetail::query()
            ->orderBy('type')
            ->orderBy('label')
            ->get()
            ->groupBy('type')
            ->sortKeys()
            ->map(function ($group) {
                return SupportDetailCollection::make($group);
            });

        if ($groups->has(TypeQuestion::TECHNICAL_ISSUES) === false) {
            $groups->put(
                TypeQuestion::TECHNICAL_ISSUES,
                SupportDetailCollection::make([
                    new SupportDetail([
                        'target' => route('enquiry-form'),
                        'label' => 'Submit an enquiry',
                    ]),
                ])
            );
        }

        return GovukPage::custom('Support', 'support.page', [])
            ->with('list', [
                'Name' => config('app.name'),
                'Acronym' => config('app.acronym'),
                'Build' => config('app.build'),
                'Laravel' => app()->version(),
                'PHP' => phpversion(),
            ])
            ->with('groups', $groups);
    }

    public function owners(string $role): RedirectResponse
    {
        $emails = User::byRole($role, 'id')
            ->pluck('email')
            ->join(';');

        return redirect("mailto:$emails?subject=".SupportDetail::getEnquirySubject());
    }
}
