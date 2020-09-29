<?php

namespace PacerIT\LaravelPolishValidationRules\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use PacerIT\LaravelPolishValidationRules\Rules\IDCardNumberRule;
use PacerIT\LaravelPolishValidationRules\Rules\NIPRule;
use PacerIT\LaravelPolishValidationRules\Rules\PESELRule;
use PacerIT\LaravelPolishValidationRules\Rules\PostCodeRule;
use PacerIT\LaravelPolishValidationRules\Rules\PWZRule;
use PacerIT\LaravelPolishValidationRules\Rules\REGONRule;

/**
 * Class LaravelPolishValidationRulesServiceProvider.
 *
 * @author Wiktor Pacer <kontakt@pacerit.pl>
 *
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
        $path = __DIR__.'/../../resources/lang';

        $this->loadTranslationsFrom($path, 'polish-validation');

        $this->publishes([
            $path => $this->app->resourcePath('lang/vendor/polish-validation'),
        ]);

        $this->registerRules();
    }

    /**
     * Register validation rules.
     *
     * @author Wiktor Pacer <kontakt@pacerit.pl>
     *
     * @since 2019-08-12
     */
    private function registerRules()
    {
        Validator::extend(
            'PESEL',
            PESELRule::class.'@passes',
            trans('polish-validation::validation.PESEL')
        );

        Validator::extend(
            'REGON',
            REGONRule::class.'@passes',
            trans('polish-validation::validation.REGON')
        );

        Validator::extend(
            'NIP',
            NIPRule::class.'@passes',
            trans('polish-validation::validation.NIP')
        );

        Validator::extend(
            'id_card_number',
            IDCardNumberRule::class.'@passes',
            trans('polish-validation::validation.id_card_number')
        );

        Validator::extend(
            'post_code',
            PostCodeRule::class.'@passes',
            trans('polish-validation::validation.post_code')
        );

        Validator::extend(
            'PWZ',
            PWZRule::class.'@passes',
            trans('polish-validation::validation.PWZ')
        );
    }
}
