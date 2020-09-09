---
title: Internal enum values
weight: 2
---

Creating enums from serialized values is done like so:

```php
$status = new StatusEnum('draft');
```

When an enum value doesn't exist, you'll get an error.

Also keep in mind that the core philosophy of this package is that you should _never_ use the enum value directly in your code. Always use the object itself. The only place where you're allowed to use `Enum::make()` is to unserialise a value into an enum object. One example is to convert a stored value in a database to an enum object.

If you want to get the value of an enum to store it, you can do this:

```php
$status->value;
```

Note that `value` is a read-only property, it cannot be changed.
