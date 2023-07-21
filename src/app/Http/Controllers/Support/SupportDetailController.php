<?php

namespace App\Http\Controllers\Support;

use AnthonyEdmonds\GovukLaravel\Helpers\GovukPage;
use App\Http\Controllers\Controller;
use App\Http\Resources\SupportDetailCollection;
use App\Models\SupportDetail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SupportDetailController extends Controller
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
