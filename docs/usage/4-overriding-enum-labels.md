---
title: Overriding enum labels
weight: 4
---

Enums can be given a label, you can do this by overriding the `labels` method. This label can be used to, for example, show a user-friendly list of available enums in a dropdown field.

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
