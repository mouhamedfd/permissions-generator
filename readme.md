# Laravel Permissions Generator

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

This package add some artisan command to help generating permissions for your declared routes.

For the permissions management this package use [Laravel-permission](https://github.com/spatie/laravel-permission/tree/main) by [Spatie](https://spatie.be/docs/laravel-permission/v5/introduction)

### Usage
Each of your routes that you want to add permission should have an alias (name) seperated by dot(.) for exemple:


```bash
Route::get('/posts/special_action',[App\Http\Controllers\PostController::class, 'specialaction'])->name('posts.specialaction');
Route::get('/posts/another_action',[App\Http\Controllers\PostController::class, 'anotheraction'])->name('posts.anotheraction');
```
In this example permissions will be generated for the PostController linked to the **specialaction** and **anotheraction**

``` bash
public function __construct()//#
{
    $this->middleware('auth');
    $this->middleware(['permission:posts.specialaction'])->only(['specialaction']);
    $this->middleware(['permission:posts.anotheraction'])->only(['anotheraction']);
        
 }//#

```




Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require mouhamedfd/permissions-generator
```
### Publish configuration
```bash
php artisan vendor:publish --tag=permissions-generator.config
```

The default configuration exclude some keywords and some columns, it's also possible to add some middlewares

```bash
return [
    'excluded_keywords'=>[
        'Auth',
        'Translation',
    ],
    'have_resource_column'=>false,
    'have_description_column'=>false,
    'middlewares'=>[
        'auth',
    ],

];
```

## Usage

Simulation mode
```bash
php artisan permission:generate

```
Database mode
```bash
php artisan permission:generate --action=database

```
Insertion to controllers
```bash
php artisan permission:generate --action=controllers

```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing [<span style="color: blue">PHPUnit</span>](https://phpunit.de/)

```bash
git clone https://github.com/mouhamedfd/permissions-generator.git
composer install
cp vendor/spatie/laravel-permission/config/permission.php vendor/orchestra/testbench-core/laravel/config/permission.php
vendor/bin/testbench cache:clear
vendor/bin/testbench config:clear
composer exec phpunit [or vendor/bin/phpunit]
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

<!-- ## Security

If you discover any security related issues, please email mouhamedfd@gmail.com instead of using the issue tracker. -->

## Credits

- [Mouhamed Fadel Diagana][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/mouhamedfd/permissions-generator.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/mouhamedfd/permissions-generator.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/mouhamedfd/permissions-generator/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/412280586/shield

[link-packagist]: https://packagist.org/packages/mouhamedfd/permissions-generator
[link-downloads]: https://packagist.org/packages/mouhamedfd/permissions-generator
[link-travis]: https://travis-ci.org/mouhamedfd/permissions-generator
[link-styleci]: https://styleci.io/repos/412280586
[link-author]: https://github.com/mouhamedfd
[link-contributors]: ../../contributors
