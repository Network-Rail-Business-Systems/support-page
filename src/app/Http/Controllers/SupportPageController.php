<?php

namespace NetworkRailBusinessSystems\SupportPage\Http\Controllers;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use NetworkRailBusinessSystems\SupportPage\Forms\SupportDetail\Questions\TypeQuestion;
use NetworkRailBusinessSystems\SupportPage\Http\Resources\SupportDetailCollection;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;

class SupportPageController extends Controller
{
    use AuthorizesRequests;

    public function show(): View
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
                        'target' => route('support-page.enquiry'),
                        'label' => 'Submit an enquiry',
                    ]),
                ])
            );
        }

        return view('support-page::show')
            ->with('list', [
                'Name' => config('app.name'),
                'Acronym' => config('app.acronym'),
                'Build' => config('app.build'), // TODO Automatic read from parent folder
                'Laravel' => app()->version(),
                'PHP' => phpversion(),
            ])
            ->with('groups', $groups);
    }

    public function owners(string $role): RedirectResponse
    {
        $emails = config('support-page.user_model')::query()
            ->whereHas('roles', function (Builder $query) use ($role) {
                $query->where('id', '=', $role);
            })
            ->orderBy('email')
            ->pluck('email')
            ->join(';');

        $subject = SupportDetail::getEnquirySubject();

        return redirect("mailto:$emails?subject=$subject");
    }

    public function index(): View
    {
        $this->checkAccess();

        return view('support-page::details.index')
            ->with('supportDetails', SupportDetailCollection::make(
                SupportDetail::query()->paginate()
            ));
    }

    public function confirm(SupportDetail $supportDetail): View
    {
        $this->checkAccess();

        return view('support-page::details.confirm')
            ->with('supportDetail', $supportDetail);
    }

    public function delete(SupportDetail $supportDetail): RedirectResponse
    {
        $this->checkAccess();

        $supportDetail->delete();

        flash()->success("Record #$supportDetail->id was successfully deleted.");

        return redirect()->route('support-page.admin.index');
    }

    protected function checkAccess(): void
    {
        if (config('support-page.permission') === true) {
            $this->authorize(config('support-page.permission'));
        }
    }
}
