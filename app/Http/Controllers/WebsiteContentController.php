<?php

namespace App\Http\Controllers;

use App\Models\WebsiteContent;
use Illuminate\Http\Request;

class WebsiteContentController extends Controller
{
    public function update(Request $request, WebsiteContent $content)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $content->update([
            'content' => $validated['content'],
        ]);

        return back()->with(
            'success',
            'Content updated successfully.'
        );
    }
}