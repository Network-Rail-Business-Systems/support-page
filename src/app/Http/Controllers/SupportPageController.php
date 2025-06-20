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
                        'target' => route(config('support-page.enquiry_route')),
                        'label' => 'Submit an enquiry',
                    ]),
                ]),
            );
        }

        $path = base_path();
        $index = strrpos($path, DIRECTORY_SEPARATOR);
        $build = substr($path, $index + 1);

        return view('support-page::show')
            ->with('list', [
                'Name' => config('app.name'),
                'Acronym' => config('app.acronym'),
                'Build' => $build,
                'Laravel' => app()->version(),
                'PHP' => phpversion(),
            ])
            ->with('groups', $groups)
            ->with('title', config('support-page.support_page_title'));
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
            ->with('title', 'Manage Support Details')
            ->with('supportDetails', SupportDetailCollection::make(
                SupportDetail::query()->paginate(),
            ));
    }

    public function confirm(SupportDetail $supportDetail): View
    {
        $this->checkAccess();

        return view('support-page::details.confirm')
            ->with('supportDetail', $supportDetail)
            ->with('action', 'deleted')
            ->with('method', 'get')
            ->with('title', 'Delete Support Detail #' . $supportDetail->id);
    }

    public function delete(SupportDetail $supportDetail): RedirectResponse
    {
        $this->checkAccess();

        $supportDetail->delete();

        flash()->success("Support detail #$supportDetail->id was successfully deleted.");

        return redirect()->route('support-page.admin.index');
    }

    /**
     * @codeCoverageIgnore
     */
    protected function checkAccess(): void
    {
        $permission = config('support-page.permission');

        if ($permission !== null) {
            $this->authorize($permission);
        }
    }
}
