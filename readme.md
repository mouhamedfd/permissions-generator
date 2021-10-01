# PermissionsGenerator

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

This package add some artisan command to help generating permissions for your declared routes.

Each route should have an alias (name) seperated by dot(.) for exemple:

In this example permissions will be generated for the PostController linked to the **specialaction** and **anotheraction**


``` bash
public function __construct()//#
{
        Route::get('/posts/special_action',[App\Http\Controllers\PostController::class, 'specialaction'])->name('posts.specialaction');

        Route::get('/posts/another_action',[App\Http\Controllers\PostController::class, 'anotheraction'])->name('posts.anotheraction');
 }//#

```




Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require mouhamedfd/permissions-generator
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

## Testing

``` bash
$ composer test
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
