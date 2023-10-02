<?php

namespace NetworkRailBusinessSystems\SupportPage\Http\Controllers\Support;

use Illuminate\Auth\Access\AuthorizationException;
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

    /**
     * @throws AuthorizationException
     */
    public function index(): View
    {
        $this->authorize('manage_support_page');

        return view('support-page::support.index')
            ->with('supportDetails', SupportDetailCollection::make(
                SupportDetail::query()->paginate()
            ));
    }

    /**
     * @throws AuthorizationException
     */
    public function confirmDelete(SupportDetail $supportDetail): View
    {
        $this->authorize('manage_support_page');

        return view('support-page::support.confirm-delete')
            ->with('supportDetail', $supportDetail);
    }

    /**
     * @throws AuthorizationException
     */
    public function delete(SupportDetail $supportDetail): RedirectResponse
    {
        $this->authorize('manage_support_page');

        $supportDetail->delete();

        flash()->success("Record #$supportDetail->id was successfully deleted.");

        return redirect()->route('support-page.index');
    }
}
