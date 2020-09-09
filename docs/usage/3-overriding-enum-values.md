---
title: Overriding enum values
weight: 3
---

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

An enum value doesn't have to be a string, as you can see in the example.
