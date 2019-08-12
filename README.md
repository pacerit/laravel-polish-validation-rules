# Laravel Polish Validation Rules
![GitHub tag (latest by date)](https://img.shields.io/github/tag-date/pacerit/laravel-polish-validation-rules?label=Version)
![GitHub](https://img.shields.io/github/license/pacerit/laravel-polish-validation-rules?label=License)
![Packagist](https://img.shields.io/packagist/dt/pacerit/laravel-polish-validation-rules?label=Downloads)
![PHP from Packagist](https://img.shields.io/packagist/php-v/pacerit/laravel-polish-validation-rules?label=PHP)

Simple Polish Validation rules for Laravel and Lumen framework

## Installation
You can install this package by composer:

    composer require pacerit/laravel-polish-validation-rules
    
For customize validaiton messages run:
For more configuration, you can publish configuration file:

    php artisan vendor:publish --provider "PacerIT\LaravelPolishValidationRules\Providers\LaravelPolishValidationRulesServiceProvider"
    
### Version compatibility
#### Laravel
Framework | Package
:---------|:--------
5.8.x     | ^1.x.x
#### Lumen
Framework | Package
:---------|:--------
5.8.x     | ^1.x.x

## Rules

1. 'PESEL' - validate [PESEL](https://pl.wikipedia.org/wiki/PESEL) number
2. 'REGON' - validate [REGON](https://pl.wikipedia.org/wiki/REGON) number
3. 'NIP' - validate [NIP](https://pl.wikipedia.org/wiki/NIP) number

## Code Authors

Algorithms for rules:
* PESEL
* REGON
* NIP

are based on code form [http://phpedia.pl/wiki/](http://phpedia.pl/wiki/).

## Changelog

Go to the [Changelog](CHANGELOG.md) for a full change history of the package.

## Security Vulnerabilities

If you discover a security vulnerability within package, please send an e-mail to Wiktor Pacer
via [kontakt@pacerit.pl](mailto:kontakt@pacerit.pl). All security vulnerabilities will be promptly addressed.

## License

This package is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
