<?php

namespace Modules\Quotes\Providers;

use Illuminate\Support\ServiceProvider;

class QuotesServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     * 
     * @return void
     */
    public function boot() {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
//            $this->app->bind('Modules\Quotes\Repositories\TemplatesInterface', function($app)
//            {
//                return new \Modules\Quotes\Repositories\TemplatesRepo( new \Modules\Quotes\Entities\Template);
//            });

        $this->app->bind(
                'Modules\Quotes\Repositories\TemplatesInterface', 'Modules\Quotes\Repositories\TemplatesRepo'
        );
        $this->app->bind(
                'Modules\Quotes\Repositories\GlobalSettingInterface', 'Modules\Quotes\Repositories\GlobalSettingRepo'
        );

        $this->app->bind(
                'Modules\Quotes\Repositories\QuoteStatusInterface', 'Modules\Quotes\Repositories\QuoteStatusRepo'
        );

        $this->app->bind(
                'Modules\Quotes\Repositories\QuotesInterface', 'Modules\Quotes\Repositories\QuotesRepo');

        $this->app->bind(
                'Modules\Quotes\Repositories\ProfileAccessoriesInterface', 'Modules\Quotes\Repositories\ProfileAccessoriesRepo'
        );

        $this->app->bind(
                'Modules\Quotes\Repositories\GlassBoardInterface', 'Modules\Quotes\Repositories\GlassBoardRepo');
        
        $this->app->bind(
                'Modules\Quotes\Repositories\QuoteActivityInterface', 'Modules\Quotes\Repositories\QuoteActivityRepo');
   

         $this->app->bind(
                'Modules\Quotes\Repositories\UserInterface', 'Modules\Quotes\Repositories\UserRepo');
    }

    /**
     * Register config.
     * 
     * @return void
     */
    protected function registerConfig() {
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('quotes.php'),
        ]);
        $this->mergeConfigFrom(
                __DIR__ . '/../Config/config.php', 'quotes'
        );
    }

    /**
     * Register views.
     * 
     * @return void
     */
    public function registerViews() {
        $viewPath = base_path('resources/views/modules/quotes');

        $sourcePath = __DIR__ . '/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
                            return $path . '/modules/quotes';
                        }, \Config::get('view.paths')), [$sourcePath]), 'quotes');
    }

    /**
     * Register translations.
     * 
     * @return void
     */
    public function registerTranslations() {
        $langPath = base_path('resources/lang/modules/quotes');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'quotes');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'quotes');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return array();
    }

}
