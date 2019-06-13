---
title: Enum Methods
weight: 3
---

## __toString()

will return the enum value.

```php
echo WeekDayEnum::make(1); // 'Montag'
```

## getIndex()

will return the enum index and could be overridden to customize the index.

```php
WeekDayEnum::monday()->getIndex(); // 1
```

## getIndices()

will return all indices available on the enum.

```php
WeekDayEnum::getIndices(); // [1, 2, 3, 4, 5, 6, 7]
```

## getValue()

will return the enum value and could be overridden to customize the value.

```php
WeekDayEnum::monday()->getValue(); // 'Montag'
```

## getValues()

will return all values available on the enum.

```php
WeekDayEnum::getValues(); // ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag']
```

## isAny()

will return `true` if the enum is equal with any of the given - otherwise `false`.

```php
WeekDayEnum::monday()->isAny(['monday', 0]); // true
```

## isEqual()

will return `true` if the enum is equal with the given - otherwise `false`.

```php
WeekDayEnum::monday()->isEqual('tuesday'); // false
```

## make()

will return an instance of the enum - further details [make enum](/enum/v2/usage/make-enum).

## toArray()

will return an associative array with the value as key and the index as value.

```php
WeekDayEnum::toArray(); // ['Montag' => 1, 'Dienstag' => 2, 'Mittwoch' => 3, 'Donnerstag' => 4, 'Freitag' => 5, 'Samstag' => 6, 'Sonntag' => 7]
```
