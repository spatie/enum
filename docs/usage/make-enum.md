---
title: Make Enum
weight: 2
---

## Make by name

```php
$monday = WeekDayEnum::make('monday');
$monday = WeekDayEnum::monday();
```

## Make by value

```php
$monday = WeekDayEnum::make('Montag');
```

## Make by index

```php
$monday = WeekDayEnum::make(1);
```

## Get all

```php
WeekDayEnum::getAll(); // returns an array of `WeekDayEnum` instances
```
