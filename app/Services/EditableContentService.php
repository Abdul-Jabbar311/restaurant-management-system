<?php

namespace App\Services;

use App\Models\EditableContent;
use Illuminate\Support\Facades\Auth;

class EditableContentService
{
    public function render($page, $key, $default)
    {
        $content = EditableContent::where('page', $page)
            ->where('key', $key)
            ->first();

        $text = $content ? $content->content : $default;

        // Only Admin sees the edit button
        if (Auth::check() && Auth::user()->role?->name === 'Admin') {

            return '
                <span class="inline-flex items-center">
                    
                    <span>' . e($text) . '</span>

                    <button
                        type="button"
                        onclick="openEditableContent(' . 
                            htmlspecialchars(json_encode($page), ENT_QUOTES, 'UTF-8') . ',' .
                            htmlspecialchars(json_encode($key), ENT_QUOTES, 'UTF-8') . ',' .
                            htmlspecialchars(json_encode($text), ENT_QUOTES, 'UTF-8') .
                        ')"
                        style="
                            display:inline-flex;
                            margin-left:8px;
                            width:28px;
                            height:28px;
                            align-items:center;
                            justify-content:center;
                            background:#f97316;
                            color:white;
                            border:none;
                            border-radius:50%;
                            cursor:pointer;
                            position:relative;
                            z-index:99999;
                        "
                        title="Edit Content">
                        ✎
                    </button>

                </span>
            ';
        }

        return e($text);
    }
}