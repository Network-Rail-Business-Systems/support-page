<?php

namespace NetworkRailBusinessSystems\SupportPage\Http\Controllers\Support;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;

class SupportController extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function support(): View
    {
        $groups = config('support-page.support_detail_model')::query()
            ->orderBy('type')
            ->orderBy('label')
            ->get()
            ->groupBy('type')
            ->sortKeys()
            ->map(function ($group) {
                return config('support-page.support_detail_collection')::make($group);
            });

        //issues changing support detail model to config config('support-page.support_detail_model')
        //adding support detail collection config works - php storm doesnt like it
        if ($groups->has(TypeQuestion::TECHNICAL_ISSUES) === false) {
            $groups->put(
                TypeQuestion::TECHNICAL_ISSUES,
                config('support-page.support_detail_collection')::make([
                    new SupportDetail([
                        'target' => route('enquiry-form'),
                        'label' => 'Submit an enquiry',
                    ]),
                ])
            );
        }

        return GovukPage::custom('Support', 'support-page::support.page', [])
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
        $emails = config('support-page.user_model')::byRole($role, 'id')
            ->pluck('email')
            ->join(';');

        return redirect("mailto:$emails?subject=".config('support-page.support_detail_model')::getEnquirySubject());
    }
}
