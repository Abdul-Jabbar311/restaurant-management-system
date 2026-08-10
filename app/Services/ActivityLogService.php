<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogService
{
    public static function log($action, $module, $description = null)
    {
        if (!Auth::check()) {
            return;
        }

        ActivityLog::create([
            'user_id'     => Auth::id(),
            'action'      => $action,
            'module'      => $module,
            'description' => $description,
            'ip_address'  => request()->ip(),
            'browser'     => request()->userAgent(),
        ]);
    }
}