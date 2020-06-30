---
title: Introduction
weight: 1
---

This package offers strongly typed enums in PHP. We don't use a simple "value" representation, so you're always working with the enum object. This allows for proper autocompletion and refactoring in IDEs.

## Word definition

-   **Name** is the uppercased method name - it is only used to make an enum.
-   **Value** is the string returned by `getValue()` - by default it's the name but you can customize it.
-   **Index** is the integer returned by `getIndex()` - by default it's the array key of the enum value it get's during resolve but you can customize it.

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

![autocomplete](../images/autocomplete.gif)

![refactor](../images/refactor.gif)

### Creating an enum from a value

```php
$status = StatusEnum::make('draft');
```

### Override enum values

By default, the string value of an enum is simply the name of that method. In the previous example it would be `draft`.

You can override the value or the index by overriding the `getValue()` or `getIndex()` method:

```php
class StatusEnum extends Enum
{
    public static function draft(): StatusEnum
    {
        return new class() extends StatusEnum {
            public function getValue(): string
            {
                return 'status.draft';
            }
            public function getIndex(): int
            {
                return 10;
            }
        };
    }

    public static function published(): StatusEnum
    {
        return new class() extends StatusEnum {
            public function getValue(): string
            {
                return 'status.published';
            }
            public function getIndex(): int
            {
                return 20;
            }
        };
    }

    public static function archived(): StatusEnum
    {
        return new class() extends StatusEnum {
            public function getValue(): string
            {
                return 'status.archived';
            }
            public function getIndex(): int
            {
                return -10;
            }
        };
    }
}
```

Overriding these methods is always optional but if you want to rely on the index we recommend to define them yourself. Otherwise they could easily change - we only use array index.

### Comparing enums

Enums can be compared using the `isEqual` method:

```php
$status->isEqual($otherStatus);
```

You can also use dynamic `is` methods:

```php
$status->isDraft(); // return a boolean
StatusEnum::isDraft($status); // return a boolean
```

Note that if you want auto completion on these `is` methods, you must add extra doc blocks on your enum classes.

### Enum specific methods

There might be a case where you want to have functionality depending on the concrete enum value.

There are several ways to do this:

-   Add a function in the enum class and using a switch statement or array mapping.
-   Use a separate class which contains this switch logic, something like enum extensions in C#.
-   Use enum specific methods, similar to Java.

This package also supports these enum specific methods.

By declaring the enum class itself as abstract, and using static constructors instead of doc comments, you're able to return an anonymous class per enum, each of them implementing the required methods.
