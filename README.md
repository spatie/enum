# PHP Enum

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/enum.svg?style=flat-square)](https://packagist.org/packages/spatie/enum)
[![Build Status](https://img.shields.io/github/workflow/status/spatie/enum/run-tests?label=tests&style=flat-square)](https://github.com/spatie/enum/actions?query=workflow%3Arun-tests)
[![Code Coverage](https://img.shields.io/coveralls/github/spatie/enum.svg?style=flat-square)](https://coveralls.io/github/spatie/enum)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/enum.svg?style=flat-square)](https://packagist.org/packages/spatie/enum)

This package offers strongly typed enums in PHP. We don't use scalar simple "value" representation, so you're always working with the enum object. This allows for proper static analysis and refactoring in IDEs.

Here's how enums are created with this package:

```php
use \Spatie\Enum\Enum;

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

// ...

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

// ...

$class->setStatus(StatusEnum::draft());
```

| Autocompletion  | Refactoring |
| ------------- | ------------- |
| ![](./docs/autocomplete.gif)  | ![](./docs/refactor.gif)  |

### Creating an enum from a value

```php
$status = new StatusEnum('draft');
```

When an enum value doesn't exist, you'll get an error. The only time you want to construct an enum from a value is when unserializing them from eg. a database.

If you want to get the value of an enum to store it, you can do this:

```php
$status->value;
```

Note that `value` is a read-only property, it cannot be changed.

### Enum labels

Enums can be given a label, you can do this by overriding the `labels` method.

```php
/**
 * @method static self draft()
 * @method static self published()
 * @method static self archived()
 */
class StatusEnum extends Enum
{
    protected static function labels(): array
    {
        return [
            'draft' => 'my draft label',
        ];
    }
}
```

You don't need to override all labels, the default label will be the enum's value. You can access an enum's label like so:

```php
$status->label;
```

Note that `label` is a read-only property, it cannot be changed.

### Comparing enums

Enums can be compared using the `equals` method:

```php
$status->equals(StatusEnum::draft());
```

You can pass the `equals` method several enums, it will return `true` if the current enum equals one of the given values.

```php
$status->equals(StatusEnum::draft(), StatusEnum::archived());
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
