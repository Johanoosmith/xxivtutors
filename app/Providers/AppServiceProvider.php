<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        
        $this->getNavigation();
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    public function getNavigation(): void
    {
        try {
            
            //if (!$this->isAdminRequest()) {
                \DB::connection()->getPdo();
                    
                if(\Schema::hasTable('categories'))
                {
                    $navigation = \DB::table('categories')
                    ->where('status', 1)
                    ->orderBy('order', 'asc')
                    ->get();

                    \View::share(compact('navigation'));
                }
            //}
        } catch (\Exception $e){
            \Log::info('Navigation is not loaded.');
        }

        /* Set settings data in table */
        $settings = \DB::table('settings')->get();
        foreach ($settings as $setting) {
           Config::set('settings.' . $setting->key, $setting->value);
        }

    }

    /**
     * Determine if the current request is for the admin panel.
     *
     * @return bool
     */
    protected function isAdminRequest(): bool
    {
        // Check if the current URL contains "admin"
        return request()->is('admin/*');
    }
}
