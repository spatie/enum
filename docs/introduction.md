---
title: Introduction
weight: 1
---

This package offers strongly typed enums in PHP. We don't use a simple "value" representation, so you're always working with the enum object. This allows for proper autocompletion and refactoring in IDEs.

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
