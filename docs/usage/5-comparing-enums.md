---
title: Comparing enums
weight: 5
---

Enums can be compared using the `equals` method:

```php
$status->equals(StatusEnum::draft());
```

You can pass several enums to the `equals` method, it will return `true` if the current enum equals one of the given values.

```php
$status->equals(StatusEnum::draft(), StatusEnum::archived());
```

Take note that only enum objects are allowed in the equals method. You're not allowed to compare enum objects to serialized enum values.
