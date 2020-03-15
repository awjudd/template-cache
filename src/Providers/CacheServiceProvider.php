<?php

namespace Awjudd\TemplateCache\Providers;

use Awjudd\TemplateCache\Directives\BladeDirective;
use Blade;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Blade::directive('cache', function($expression) {
            return "<?php if (! app('Awjudd\TemplateCache\Directives\BladeDirective')->setUp({$expression})) : ?>";
        });

        Blade::directive('endcache', function() {
            return "<?php endif; echo app('Awjudd\TemplateCache\Directives\BladeDirective')->tearDown() ?>";
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(BladeDirective::class);
    }
}
