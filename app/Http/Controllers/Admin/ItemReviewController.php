<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ItemStatusUpdateRequest;
use App\Models\Item;
use App\Models\ItemChangeLog;
use App\Models\ItemHistory;
use App\Services\MailSenderService;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

class ItemReviewController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:review products'),
        ];
    }

    public function pending(): View
    {
        $items = Item::where('status', 'pending')->paginate(25);
        return view('admin.item-reviews.pending', compact('items'));
    }
    public function approved(): View
    {
        $items = Item::where('status', 'approved')->paginate(25);
        return view('admin.item-reviews.approved', compact('items'));
    }
    public function resubmitted(): View
    {
        $items = Item::where('status', 'resubmitted')->paginate(25);
        return view('admin.item-reviews.resubmitted', compact('items'));
    }
    public function softRejected(): View
    {
        $items = Item::where('status', 'soft_rejected')->paginate(25);
        return view('admin.item-reviews.soft-rejected', compact('items'));
    }
    public function hardRejected(): View
    {
        $items = Item::where('status', 'hard_rejected')->paginate(25);
        return view('admin.item-reviews.hard-rejected', compact('items'));
    }

    public function show(string $id)
    {
        $item = Item::with('histories')->findOrFail($id);
        return view('admin.item-reviews.show', compact('item'));
    }

    public function updateStatus(ItemStatusUpdateRequest $request, string $id): RedirectResponse
    {
        $item = Item::findOrFail($id);
        $item->status = $request->status;
        $item->save();

        $history = new ItemHistory();
        $history->item_id = $item->id;
        $history->status = $request->status;
        $history->author_id = $item->author_id;
        $history->reviewer_id = admin()->id;
        switch ($request->status) {
            case 'approved':
                $history->title = 'Item has been approved!';
                $history->body = 'Your item has been approved and is now live on the platform.';
                break;
            case 'soft_rejected':
                $history->title = 'Item has been soft rejected';
                $history->body = $request->reason;
                break;
            case 'hard_rejected':
                $history->title = 'Item has been hard rejected.';
                $history->body = $request->reason;
                break;
        }

        $history->save();

        /* Send mail */
        MailSenderService::sendMail(
            receiverName: $item->author->name,
            receiverMail: $item->author->email,
            mailSubject: "$history->title | $item->name",
            mailContent: $history->body
        );

        NotificationService::UPDATED();
        return redirect()->back();
    }

    public function downloadItem(string $id)
    {
        $item = Item::where('id', $id)->firstOrFail();

        if ($item->is_main_file_external) {
            return redirect()->away($item->main_file);
        }

        abort_unless(Storage::disk('local')->exists($item->main_file), 404, 'File not found.');

        return Storage::disk('local')->download($item->main_file, basename($item->main_file));
    }

    public function changeLogStore(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'version' => 'required|string|max:30',
            'description' => 'required|string|max:1000',
        ]);
        $item = Item::where('id', $id)->where('author_id', user()->id)->firstOrFail();
        $item::changelogs()->create([
            'version' => $request->version,
            'description' => $request->description,
        ]);

        NotificationService::UPDATED();
        return redirect()->back();
    }
}
