---
title: Compare Enums
weight: 4
---

## Check if enums are equal

Equality enums mean that their values are identical.

```php
WeekDayEnum::monday()->isEqual(5); // false
WeekDayEnum::monday()->isEqual('monday'); // true
WeekDayEnum::monday()->isEqual('Montag'); // true
WeekDayEnum::monday()->isEqual(WeekDayEnum::tuesday()); // false
```

## Check if enum is one of

```php
WeekDayEnum::monday()->isAny(['monday', 0, WeekDayEnum::tuesday()]); // true
```

## Check if enum is specific one

You can use the magic `isXyz()` methods and add the to the doc-block for code-completion. There are two options for these magic methods static and non-static.

```php
WeekDayEnum::isMonday(5); // false
WeekDayEnum::isMonday('monday'); // true
WeekDayEnum::isMonday('Montag'); // true
WeekDayEnum::tuesday()->isMonday(); // false
```
