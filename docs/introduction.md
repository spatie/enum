---
title: Introduction
weight: 1
---

This package offers strongly typed enums in PHP. We don't use a simple "value" representation, so you're always working with the enum object. This allows for proper autocompletion and refactoring in IDEs.

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

![autocomplete](../images/autocomplete.gif)

![refactor](../images/refactor.gif)

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
        'draft' => '1',
        'published' => 'other published value',
        'archived' => '-10',
    ];
}
```

Mapping values is optional.

> Note that mapped values should always be strings.

### Comparing enums

Enums can be compared using the `equals` method:

```php
$status->equals($otherStatus);
```

You can also use dynamic `is` methods:

```php
$status->isDraft(); // return a boolean
```

Note that if you want auto completion on these `is` methods, you must add extra doc blocks on you enum classes. 

### Enum specific methods

There might be a case where you want to have functionality depending on the concrete enum value.

There are several ways to do this:

- Add a function in the enum class and using a switch statement or array mapping.
- Use a separate class which contains this switch logic, something like enum extensions in C#.
- Use enum specific methods, similar to Java. 

This package also supports these enum specific methods. 
Here's how you can implement them:

```php
abstract class MonthEnum extends Enum
{
    abstract public function getNumericIndex(): int;

    public static function january(): MonthEnum
    {
        return new class() extends MonthEnum
        {
            public function getNumericIndex(): int
            {
                return 1;
            }
        };
    }

    public static function february(): MonthEnum
    {
        return new class() extends MonthEnum
        {
            public function getNumericIndex(): int
            {
                return 2;
            }
        };
    }
    
    // …
}
```

By declaring the enum class itself as abstract, 
and using static constructors instead of doc comments, 
you're able to return an anonymous class per enum, each of them implementing the required methods.

You can use this enum the same way as any other:

```php
MonthEnum::january()->getNumericIndex()
``` 

Note that one drawback of this approach is that the value of the enum
**is always** the name of the static function, there's no way of mapping it.
