<?php

namespace NetworkRailBusinessSystems\SupportPage\Http\Controllers\Support;

use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Http\Resources\SupportDetailCollection;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;

class SupportDetailController extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function index(): View
    {
        return view('support-page::support.index')
            ->with('supportDetails', SupportDetailCollection::make(
                SupportDetail::query()->paginate()
            ));
    }

    public function delete(SupportDetail $supportDetail): RedirectResponse
    {
        $supportDetail->delete();

        flash()->success("Record $supportDetail->id delete.");

        return redirect()->route('support-details.index');

    }

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

        return view('support-page::support.page')
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
