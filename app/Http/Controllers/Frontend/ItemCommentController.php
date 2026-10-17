<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemComment;
use App\Services\NotificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ItemCommentController extends Controller
{
    public function store(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'comment' => ['required', 'string', 'max: 1000'],
        ]);

        $item = Item::findOrFail($id);

        $comment = new ItemComment;
        $comment->item_id = $item->id;
        $comment->user_id = user()->id;
        $comment->comment = $request->comment;
        $comment->save();

        NotificationService::CREATED('Comment added successfully.');

        return redirect()->back();
    }
}
