
[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/support-ukraine.svg?t=1" />](https://supportukrainenow.org)

# PHP Enum

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/enum.svg?style=for-the-badge)](https://packagist.org/packages/spatie/enum)
[![License](https://img.shields.io/github/license/spatie/enum?style=for-the-badge)](https://github.com/spatie/enum/blob/master/LICENSE.md)
![Postcardware](https://img.shields.io/badge/Postcardware-%F0%9F%92%8C-197593?style=for-the-badge)

[![PHP from Packagist](https://img.shields.io/packagist/php-v/spatie/enum?style=flat-square)](https://packagist.org/packages/spatie/enum)
[![Build Status](https://img.shields.io/github/workflow/status/spatie/enum/run-tests?label=tests&style=flat-square)](https://github.com/spatie/enum/actions?query=workflow%3Arun-tests)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/enum.svg?style=flat-square)](https://packagist.org/packages/spatie/enum)

This package offers strongly typed enums in PHP. In this package, enums are always objects, never constant values on their own. This allows for proper static analysis and refactoring in IDEs.

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

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/enum.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/enum)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

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
$status = StatusEnum::from('draft');
```

When an enum value doesn't exist, you'll get a `BadMethodCallException`. If you would prefer not catching an exception, you can use:

```php
$status = StatusEnum::tryFrom('draft');
```

When an enum value doesn't exist in this case, `$status` will be `null`.

The only time you want to construct an enum from a value is when unserializing them from eg. a database.

If you want to get the value of an enum to store it, you can do this:

```php
$status->value;
```

Note that `value` is a read-only property, it cannot be changed.

### Enum values

By default, the enum value is its method name. You can however override it, for example if you want to store enums as integers in a database, instead of using their method name.

```php
/**
 * @method static self draft()
 * @method static self published()
 * @method static self archived()
 */
class StatusEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'draft' => 1,
            'published' => 2,
            'archived' => 3,
        ];
    }
}
```

An enum value doesn't have to be a `string`, as you can see in the example it can also be an `int`.

Note that you don't need to override all values. Rather, you only need to override the ones that you want to be different from the default.

If you have a logic that should be applied to all method names to get the value, like lowercase them, you can return a `Closure`.

```php
/**
 * @method static self DRAFT()
 * @method static self PUBLISHED()
 * @method static self ARCHIVED()
 */
class StatusEnum extends Enum
{
    protected static function values(): Closure
    {
        return function(string $name): string|int {
            return mb_strtolower($name);
        };
    }
}
```

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

Note that you don't need to override all labels, the default label will be the enum's value.

If you have a logic that should be applied to all method names to get the label, like lowercase them, you can return a `Closure` as in the value example.

You can access an enum's label like so:

```php
$status->label;
```

Note that `label` is a read-only property, it cannot be changed.

### Comparing enums

Enums can be compared using the `equals` method:

```php
$status->equals(StatusEnum::draft());
```

You can pass several enums to the `equals` method, it will return `true` if the current enum equals one of the given values.

```php
$status->equals(StatusEnum::draft(), StatusEnum::archived());
```

### Phpunit Assertions

This package provides an abstract class `Spatie\Enum\Phpunit\EnumAssertions` with some basic/common assertions if you have to test enums.

```php
use Spatie\Enum\Phpunit\EnumAssertions;

EnumAssertions::assertIsEnum($post->status); // checks if actual extends Enum::class
EnumAssertions::assertIsEnumValue(StatusEnum::class, 'draft'); // checks if actual is a value of given enum
EnumAssertions::assertIsEnumLabel(StatusEnum::class, 'draft'); // checks if actual is a label of given enum
EnumAssertions::assertEqualsEnum(StatusEnum::draft(), 'draft'); // checks if actual (transformed to enum) equals expected
EnumAssertions::assertSameEnum(StatusEnum::draft(), $post->status); // checks if actual is same as expected
EnumAssertions::assertSameEnumValue(StatusEnum::draft(), 1); // checks if actual is same value as expected
EnumAssertions::assertSameEnumLabel(StatusEnum::draft(), 'draft'); // checks if actual is same label as expected
```

### Faker Provider

Possibly you are using [faker](https://github.com/FakerPHP/Faker) and want to generate random enums.
Because doing so with default faker is a lot of copy'n'paste we've got you covered with a faker provider `Spatie\Enum\Faker\FakerEnumProvider`.

```php
use Spatie\Enum\Faker\FakerEnumProvider;
use Faker\Generator as Faker;

/** @var Faker|FakerEnumProvider $faker */
$faker = new Faker();
$faker->addProvider(new FakerEnumProvider($faker));

$enum = $faker->randomEnum(StatusEnum::class);
$value = $faker->randomEnumValue(StatusEnum::class);
$label = $faker->randomEnumLabel(StatusEnum::class);
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

### Security

If you've found a bug regarding security please mail [security@spatie.be](mailto:security@spatie.be) instead of using the issue tracker.

## Postcardware

You're free to use this package, but if it makes it to your production environment we highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Kruikstraat 22, 2018 Antwerp, Belgium.

We publish all received postcards [on our company website](https://spatie.be/en/opensource/postcards).

## Credits

- [Brent Roose](https://github.com/brendt)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
