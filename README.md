# PHP Enum

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/enum.svg?style=flat-square)](https://packagist.org/packages/spatie/:package_name)
[![Build Status](https://img.shields.io/travis/spatie/enum/master.svg?style=flat-square)](https://travis-ci.org/spatie/:package_name)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/enum.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/:package_name)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/enum.svg?style=flat-square)](https://packagist.org/packages/spatie/:package_name)

Strongly typed enums in PHP supporting autocompletion and refactoring.

## Installation

You can install the package via composer:

```bash
composer require spatie/enum
```

## Usage

You're probably aware of the excellent [myclabs/php-enum](https://github.com/myclabs/php-enum) package.
This package adds enum support via constants in PHP. 
There are three problems with it though:

- There are two ways of using an enum value: `MyEnum::VALUE` or `MyEnum::VALUE()`, this often causes inconsistencies throughout the codebase.
- There's no autocompletion when using static calls.
- Refactoring a constant name in your IDE will result on broken code, as the static method calls aren't refactored.

This package solves those problems. It does so in an unconventional way though.
Here's how you define an enum with this package:

```php
/**
 * @method static self DRAFT()
 * @method static self PUBLISHED()
 * @method static self ARCHIVED()
 */
final class StatusEnum extends Enum
{
}
```

> Note that the `final` is optional, but it is a good practice.

The docblock approach can be controversial and seen as "magic".
On the other hand: all enum packages are depending on magic anyways, so this shouldn't be a show stopper.

These enum classes can be used like so:

```php
public function setStatus(StatusEnum $status): void
{
    $this->status = $status;
}

// …

$class->setStatus(StatusEnum::DRAFT());
```

### Override enum string values

By default, the string value if an enum, for example to store in a database, 
is simply the name of that method. 
In the previous example it would be `DRAFT`.

You can override this value, but added a description to the docblock definition:

```php
/**
 * @method static self DRAFT() draft
 * @method static self PUBLISHED() published
 * @method static self ARCHIVED() archived
 */
final class StatusEnum extends Enum
{
}
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Postcardware

You're free to use this package, but if it makes it to your production environment we highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Samberstraat 69D, 2060 Antwerp, Belgium.

We publish all received postcards [on our company website](https://spatie.be/en/opensource/postcards).

## Credits

- [Brent Roose](https://github.com/brendt)
- [All Contributors](../../contributors)

## Support us

Spatie is a webdesign agency based in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

Does your business depend on our contributions? Reach out and support us on [Patreon](https://www.patreon.com/spatie). 
All pledges will be dedicated to allocating workforce on maintenance and new awesome stuff.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
