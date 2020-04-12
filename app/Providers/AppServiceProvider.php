<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_DEBUG') && env('APP_ENV') == 'local') {
            app('db') -> listen(function ($query) {
                app('files')->append(
                    storage_path("/logs/query-" . date('Y-m-d') . ".log"),
                    '[' .date('Y-m-d H:i:s'). '] '
                    . $query->sql
                    . ' [bindings: ' . implode(', ', $query->bindings) . ']'
                    . ' [time: ' . $query->time . ']'
                    . PHP_EOL
                );
            });
        }
    }
}
