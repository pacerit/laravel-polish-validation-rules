# Laravel Polish Validation Rules
![GitHub tag (latest by date)](https://img.shields.io/github/tag-date/pacerit/laravel-polish-validation-rules?label=Version)
![GitHub](https://img.shields.io/github/license/pacerit/laravel-polish-validation-rules?label=License)
![Packagist](https://img.shields.io/packagist/dt/pacerit/laravel-polish-validation-rules?label=Downloads)
![PHP from Packagist](https://img.shields.io/packagist/php-v/pacerit/laravel-polish-validation-rules?label=PHP)
[![StyleCI](https://github.styleci.io/repos/201912664/shield?branch=master)](https://github.styleci.io/repos/201912664)
[![<PacerIT>](https://circleci.com/gh/pacerit/laravel-polish-validation-rules.svg?style=svg)](https://circleci.com/gh/pacerit/laravel-polish-validation-rules)

Simple Polish Validation rules for Laravel and Lumen framework

## Installation
You can install this package by composer:

    composer require pacerit/laravel-polish-validation-rules
    
For customize validaiton messages run:

    php artisan vendor:publish --provider "PacerIT\LaravelPolishValidationRules\Providers\LaravelPolishValidationRulesServiceProvider"
    
### Version compatibility
#### Laravel/Lumen
Framework | Package | Note
:---------|:--------|:------
5.8.x      | ^1.x.x  | No longer maintained.
6.0.x      | ^2.x.x  | No longer maintained.
7.x.x      | ^3.x.x  | No longer maintained.
8.x.x      | ^4.x.x  | PHP ^8.0 Supported from 4.0.3, Bug fixes only. No longer maintained.
9.x.x      | ^5.x.x  |
10.x.x     | ^6.x.x  |
11.x.x     | ^7.x.x  |
12.x.x     | ^8.x.x  |

## Rules

1. 'PESEL' - validate [PESEL](https://pl.wikipedia.org/wiki/PESEL) number. We can validate additional parameters:
   * Gender - check if gender value in PESEL
     * `gender_male`
     * `gender_female`
   * Birth date - checking if birth date decoded from PESEL number is before or after date defined in rules
     * `born_before,Y-m-d` - i.e. `PESEL:born_before,2022-01-01`
     * `born_after,Y-m-d` - i.e. `PESEL:born_after,2000-01-01`
2. 'REGON' - validate [REGON](https://pl.wikipedia.org/wiki/REGON) number
3. 'NIP' - validate [NIP](https://pl.wikipedia.org/wiki/NIP) number
4. 'id_card_number' - validate Polish ID Card number
5. 'post_code' - validate Polish post codes. By default accept codes in format 00-000 and 00000. You can change this with options:
   * with_dash - only post codes with format 00-000 are valid
   * without_dash - only post code with format 00000 are valid
6. 'PWZ' - validate PWZ (Prawo wykonywania zawodu lekarza/farmaceuty) numer (more information [HERE](https://nil.org.pl/rejestry/centralny-rejestr-lekarzy/zasady-weryfikowania-nr-prawa-wykonywania-zawodu))
7. 'passport_number' - validate Polish passport number

## Usage example

Without optional parameters
```php
$validator = Validator::make(
    $request->all(),
    [
        'post_code'  => 'post_code',
        'pesel'      => 'PESEL',
        'nip_number' => 'NIP',
    ]
);
```

With optional parameters
```php
$validator = Validator::make(
    $request->all(),
    [
        'post_code' => 'post_code:without_dash',
        'pesel'     => 'PESEL:gender_female',
    ]
);
```

Multiple options
```php
$validator = Validator::make(
    $request->all(),
    [
        'pesel' => 'PESEL:gender_male:born_before,2022-01-01:born_after,2000-01-01',
    ]
);
```

## Code Authors

The algorithms used in the functions are based on existing solutions. Below are links to the sources:

* PESEL
  * checksum checking algorithm - [http://phpedia.pl/wiki/PESEL](http://phpedia.pl/wiki/PESEL)
  * extract/validate bith date - [KKSzymanowski/PESEL](https://github.com/KKSzymanowski/PESEL/blob/master/src/Pesel.php)
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
