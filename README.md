# Laravel Administrable Crudgenerator

[![Packagist](https://img.shields.io/packagist/v/guysolamour/laravel-administrable-crudgenerator.svg)](https://packagist.org/packages/guysolamour/laravel-administrable-crudgenerator)
[![Packagist](https://poser.pugx.org/guysolamour/laravel-administrable-crudgenerator/d/total.svg)](https://packagist.org/packages/guysolamour/laravel-administrable-crudgenerator)
[![Packagist](https://img.shields.io/packagist/l/guysolamour/laravel-administrable-crudgenerator.svg)](https://packagist.org/packages/guysolamour/laravel-administrable-crudgenerator)


This package allows you to automatically generate the crud of a model from a declaration file that uses the yaml format. Several files are created such as model, migration, controller and views.

This package is an extension of the package - [laravel-administrable](https://github.com/guysolamour/administrable) and cannot be used outside of it.
For the complete documentation [it's here](https://guysolamour.github.io/laravel-administrable/).


## Installation

Install via composer
```bash
composer require guysolamour/laravel-administrable-crudgenerator
```

### Publish package assets

```bash
php artisan vendor:publish --provider="Guysolamour\Administrable\Crudgenerator\ServiceProvider"
```

## Security

If you discover any security related issues, please email rolandassale@gmail.com
instead of using the issue tracker.

## Credits

- [Guy-roland ASSALE](https://github.com/guysolamour/laravel-administrable-crudgenerator)
- [All contributors](https://github.com/guysolamour/laravel-administrable-crudgenerator/graphs/contributors)

This package is bootstrapped with the help of
[melihovv/laravel-package-generator](https://github.com/melihovv/laravel-package-generator).
