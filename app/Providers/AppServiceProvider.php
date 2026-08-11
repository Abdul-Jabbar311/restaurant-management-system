<?php

namespace App\Providers;

use App\Models\WebsiteContent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Blade::directive('editable', function ($expression) {
    return "<?php echo app(\App\Services\EditableContentService::class)->render({$expression}); ?>";
});
    }
}

