<?php

namespace Networkrailbusinesssystems\SupportPage\Http\Controllers\Support;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Networkrailbusinesssystems\SupportPage\Http\Resources\SupportDetailCollection;
use Networkrailbusinesssystems\SupportPage\Models\SupportDetail;

class SupportDetailController extends BaseController
{
    public function index(): View
    {
        return GovukPage::custom('Manage Support Details', 'support.index', [
            'Admin' => route('dashboard.admin'),
            'Manage Support Details' => route('support-details.index'),
        ])->with('supportDetails', SupportDetailCollection::make(
            SupportDetail::query()->paginate()
        ));
    }

    public function delete(SupportDetail $supportDetail): RedirectResponse
    {
        $supportDetail->delete();
        flash()->success("Record $supportDetail->id deleted.");

        return redirect()->route('support-details.index');
    }
}
