# PHP Enum

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/enum.svg?style=flat-square)](https://packagist.org/packages/spatie/enum)
[![Build Status](https://img.shields.io/travis/spatie/enum/master.svg?style=flat-square)](https://travis-ci.org/spatie/enum)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/enum.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/enum)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/enum.svg?style=flat-square)](https://packagist.org/packages/spatie/enum)

This package offers strongly typed enums in PHP. We don't use a simple "value" representation, so you're always working with the enum object. This allows for proper autocompletion and refactoring in IDEs.

Here's how enums are created with this package:

```php
/**
 * @method static self draft()
 * @method static self published()
 * @method static self archived()
 */
class StatusEnum extends Enum
{
}
```

And this is how they are used:

```php
public function setStatus(StatusEnum $status): void
{
    $this->status = $status;
}

// …

$class->setStatus(StatusEnum::draft());
```

## Installation

You can install the package via composer:

```bash
composer require spatie/enum
```

## Usage

This is how an enum can be defined.

```php
/**
 * @method static self draft()
 * @method static self published()
 * @method static self archived()
 */
class StatusEnum extends Enum
{
}
```

This is how they are used:

```php
public function setStatus(StatusEnum $status)
{
    $this->status = $status;
}

// …

$class->setStatus(StatusEnum::draft());
```

![](./docs/autocomplete.gif)

![](./docs/refactor.gif)

### Creating an enum from a value

```php
$status = StatusEnum::from('draft');

// or

$status = new StatusEnum('published');
```

### Override enum values

By default, the string value of an enum  is simply the name of that method. 
In the previous example it would be `draft`.

You can override this value, by adding the `$map` property:

```php
/**
 * @method static self draft()
 * @method static self published()
 * @method static self archived()
 */
class StatusEnum extends Enum
{
    protected static $map = [
        'draft' => 1,
        'published' => 'other published value',
        'archived' => -10,
    ];
}
```

Mapping values is optional.

### Comparing enums

Enums can be compared using the `equals` method:

```php
$status->equals($otherStatus);
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
