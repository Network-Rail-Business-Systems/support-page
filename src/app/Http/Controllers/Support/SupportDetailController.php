<?php

namespace NetworkRailBusinessSystems\SupportPage\Http\Controllers\Support;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use NetworkRailBusinessSystems\SupportPage\Http\Resources\SupportDetailCollection;
use NetworkRailBusinessSystems\SupportPage\Models\SupportDetail;

class SupportDetailController extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function index(): View
    {
        return GovukPage::custom('Manage Support Details', 'support-page::support.index', [
            'Admin' => route('dashboard.admin'),
            'Manage Support Details' => route('support-details.index'),
        ])->with('supportDetails', SupportDetailCollection::make(
            SupportDetail::query()->paginate()
        ));
    }

    public function delete(SupportDetail $supportDetail): RedirectResponse
    {
        $supportDetail->delete();

        flash()->success("Record $supportDetail->id delete.");

        return redirect()->route('support-details.index');

    }
}
