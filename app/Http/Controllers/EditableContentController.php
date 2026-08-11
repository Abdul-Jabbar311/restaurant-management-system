<?php

namespace App\Http\Controllers;

use App\Models\EditableContent;
use Illuminate\Http\Request;

class EditableContentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Edit Content
    |--------------------------------------------------------------------------
    */

    public function edit($page, $key)
    {
        $content = EditableContent::where('page', $page)
            ->where('key', $key)
            ->first();

        if (!$content) {

            $content = new EditableContent();

            $content->page = $page;
            $content->key = $key;
            $content->content = '';
        }

        return view('admin.editable-content.edit', [
            'content' => $content,
            'page' => $page,
            'key' => $key,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Update Content
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $page, $key)
    {
        $request->validate([
            'content' => 'required|string',
        ]);


        EditableContent::updateOrCreate(
            [
                'page' => $page,
                'key' => $key,
            ],
            [
                'content' => $request->input('content'),
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Return JSON response
        |--------------------------------------------------------------------------
        |
        | The frontend JavaScript uses fetch() and expects JSON.
        | Do NOT redirect here.
        |
        */

        return response()->json([
            'success' => true,
            'message' => 'Content updated successfully.',
        ]);
    }
}
