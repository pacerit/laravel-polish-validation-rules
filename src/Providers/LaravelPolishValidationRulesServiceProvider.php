<?php

namespace PacerIT\LaravelPolishValidationRules\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use PacerIT\LaravelPolishValidationRules\Rules\NIPRule;
use PacerIT\LaravelPolishValidationRules\Rules\PESELRule;
use PacerIT\LaravelPolishValidationRules\Rules\REGONRule;

/**
 * Class LaravelPolishValidationRulesServiceProvider
 *
 * @package PacerIT\LaravelPolishValidationRules\Providers
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 * @since 2019-08-12
 */
class LaravelPolishValidationRulesServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $path = __DIR__ . '/../../resources/lang';

        $this->loadTranslationsFrom($path, 'polish-validation');

        $this->publishes([
            __DIR__.'/path/to/translations' => $this->app->configPath('lang/vendor/courier'),
        ]);

        $this->registerRules();
    }

    /**
     * Register validation rules
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     * @since 2019-08-12
     */
    private function registerRules()
    {
        Validator::extend('PESEL', PESELRule::class . '@passes');
        Validator::extend('REGON', REGONRule::class . '@passes');
        Validator::extend('NIP', NIPRule::class . '@passes');
    }

}
