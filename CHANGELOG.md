# Changelog
## v.6.0.0
    - update dependencies for Laravel and Lumen 10.x.x compatibility (thanks krzysztofrewak!)
## v.5.1.0
**Possible breaking changes while updating from previous version. See upgrade guide [here](UPGRADE_GUIDE.md)**

    - fix PESEL validation for numbers with birth date encoded incorrectly (thanks bbprojectnet!)
    - add new options for PESEL rule - born_before, born_after (see README.md)
    - drop support for Laravel 6.x and 7.x
## v.5.0.1
    - use langPath to support new lang folder in Laravel 9 (thanks wbaryla!)
## v.5.0.0
    - update post_code rule - add support for options (see README.md)
    - update PESEL rule - add suport for options (see README.md)
    - update dependencies for Laravel and Lumen 9.x.x compatibility
## v.4.0.5
    - add passport_numer role
## v.4.0.4
    - fix typo in English translations (thanks mhajder!)
## v.4.0.3
    - compatibility with PHP version 8.x (updated composer.json file)
## v.4.0.2
    - add PWZ rule
## v.4.0.1
    - add post_code rule
## v.4.0.0
    - update dependencies for Laravel and Lumen 8.x.x compatibility
## v.3.0.0
    - update dependencies for Laravel and Lumen 7.x.x compatibility
## v.2.0.2
    - rules now implement Illuminate\Contracts\Validation\Rule interface
    - remove composer.lock file
## v.2.0.1
    - fix validation while value is null
    - update unit tests
## v.2.0.0
    - update dependencies for Laravel and Lumen 6.0.x compatibility