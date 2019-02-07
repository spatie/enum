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

This package aims to provide an enum implementation in PHP that has several benefits for developers:

- Strongly typed enums objects, without a simple "value" representation. In other words:
you're always working with an enum object, and never with its value directly.
- Autocompletion support in IDEs.
- Proper refactor support in IDEs.

Here's how this package does that:

```php
/**
 * @method static self DRAFT()
 * @method static self PUBLISHED()
 * @method static self ARCHIVED()
 */
class StatusEnum extends Enum
{
}
```

An enums can be used like so:

```php
public function setStatus(StatusEnum $status): void
{
    $this->status = $status;
}

// …

$class->setStatus(StatusEnum::DRAFT());
```

### Override enum string values

By default, the string value of an enum  is simply the name of that method. 
In the previous example it would be `DRAFT`.

You can override this value, by adding a description to the docblock definition:

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

### What about creating an enum from a stored value?

As soon as enum values are stored in the database or anywhere else, 
you cannot be sure anymore that a refactor to them won't break anything.

That's why the package, as of now, makes no decisions on how to rebuild an enum from its values.
If you want to do this, you'll have to make a factory yourself.

We might add a basic factory soon, but this might not work in all cases.

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
