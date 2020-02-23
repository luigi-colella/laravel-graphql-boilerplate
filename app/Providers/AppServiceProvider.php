<?php

namespace App\Providers;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        // Log queries if you are in the local environment
        if (app()->isLocal()) {
            DB::listen(function (QueryExecuted $query) {
                $time = $query->time;
                $query = vsprintf(str_replace('?', '%s', $query->sql), $query->bindings);
                Log::info("A query was executed in {$time}ms: \"{$query}\"");
            });
        }
    }
}
