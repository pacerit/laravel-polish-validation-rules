# Laravel Polish Validation Rules
![GitHub tag (latest by date)](https://img.shields.io/github/tag-date/pacerit/laravel-polish-validation-rules?label=Version)
![GitHub](https://img.shields.io/github/license/pacerit/laravel-polish-validation-rules?label=License)
![Packagist](https://img.shields.io/packagist/dt/pacerit/laravel-polish-validation-rules?label=Downloads)
![PHP from Packagist](https://img.shields.io/packagist/php-v/pacerit/laravel-polish-validation-rules?label=PHP)
[![StyleCI](https://github.styleci.io/repos/201912664/shield?branch=master)](https://github.styleci.io/repos/201912664)
[![Build Status](https://travis-ci.com/pacerit/laravel-polish-validation-rules.svg?branch=master)](https://travis-ci.com/pacerit/laravel-polish-validation-rules)

Simple Polish Validation rules for Laravel and Lumen framework

## Installation
You can install this package by composer:

    composer require pacerit/laravel-polish-validation-rules
    
For customize validaiton messages run:

    php artisan vendor:publish --provider "PacerIT\LaravelPolishValidationRules\Providers\LaravelPolishValidationRulesServiceProvider"
    
### Version compatibility
#### Laravel
Framework | Package
:---------|:--------
5.8.x     | ^1.x.x
6.0.x     | ^2.x.x
7.x.x     | ^3.x.x
#### Lumen
Framework | Package
:---------|:--------
5.8.x     | ^1.x.x
6.0.x     | ^2.x.x
7.x.x     | ^3.x.x

## Rules

1. 'PESEL' - validate [PESEL](https://pl.wikipedia.org/wiki/PESEL) number
2. 'REGON' - validate [REGON](https://pl.wikipedia.org/wiki/REGON) number
3. 'NIP' - validate [NIP](https://pl.wikipedia.org/wiki/NIP) number
4. 'id_card_number' - validate Polish ID Card number

## Code Authors

The algorithms used in the functions are based on existing solutions. Below are links to the sources:

* PESEL - [http://phpedia.pl/wiki/PESEL](http://phpedia.pl/wiki/PESEL)
* REGON - [http://phpedia.pl/wiki/REGON](http://phpedia.pl/wiki/REGON)
* NIP - [http://phpedia.pl/wiki/NIP](http://phpedia.pl/wiki/NIP)
* id_card_number - [http://www.algorytm.org](http://www.algorytm.org/numery-identyfikacyjne/numer-dowodu-osobistego/do-php.html)

## Changelog

Go to the [Changelog](CHANGELOG.md) for a full change history of the package.

## Testing

    composer test

## Security Vulnerabilities

If you discover a security vulnerability within package, please send an e-mail to Wiktor Pacer
via [kontakt@pacerit.pl](mailto:kontakt@pacerit.pl). All security vulnerabilities will be promptly addressed.

## License

This package is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
