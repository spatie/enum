# Changelog

All notable changes to `enum` will be documented in this file

## 2.3.8 - 2020-07-17

- Fix for static `isXyz($value)` magic methods tto return `false` on invalid value - follow up fix to [v2.3.3](#233---2019-09-25) - [#62](https://github.com/spatie/enum/pull/62)

## 2.3.7 - 2020-06-30

- Fix internal usage of `toArray()` to allow custom array representations [#58](https://github.com/spatie/enum/pull/58)

## 2.3.6 - 2020-03-11

- Fix the name if it's matched but isn't the same [#50](https://github.com/spatie/enum/pull/50)

## 2.3.5 - 2020-02-11

- Fix for `isEqual()` and `isAny()` method doc-tags to accept `mixed` values 

## 2.3.4 - 2020-01-17

- Fix for static method call passed to `__call` within the context of an object

## 2.3.3 - 2019-09-25

- Allow passing invalid string values to `isEqual()` [#39](https://github.com/spatie/enum/pull/39)

## 2.3.1 - 2019-08-19

- Fix `protected` method calls to allow overrides [#37](https://github.com/spatie/enum/pull/37)

## 2.3.0 - 2019-08-05

- Make `\Spatie\Enum\Enumerable::isValidIndex/Name/Value()` methods public [#36](https://github.com/spatie/enum/pull/36)
  > Please note that this could be breaking for custom implementations of the `\Spatie\Enum\Enumerable` interface.

## 2.2.0 - 2019-07-18

- Add `\Spatie\Enum\Enum::getAll()` method [#33](https://github.com/spatie/enum/pull/33)

## 2.1.2 - 2019-05-07

- Fix calling public non-static methods [#32](https://github.com/spatie/enum/pull/32)

## 2.1.1 - 2019-04-18

- Fix overriden existing public static methods like `Enum::toArray()` [#29](https://github.com/spatie/enum/pull/29)

## 2.1.0 - 2019-04-17

- Add enum map index and value `Enum::MAP_INDEX` and `Enum::MAP_VALUE` [#25](https://github.com/spatie/enum/pull/25)

## 2.0.1 - 2019-04-08

- Improved static analysis support for `::make`

## 2.0.0 - 2019-04-01

A full major rework of the `Enum` class - we try to list all changes, for more details you can check out the [PR](https://github.com/spatie/enum/pull/18) and the [Issue](https://github.com/spatie/enum/issues/10).

- Add `\Spatie\Enum\Enumerable` interface
- Add `\Spatie\Enum\Exceptions\DuplicatedIndexException`, `\Spatie\Enum\Exceptions\DuplicatedValueException`, `\Spatie\Enum\Exceptions\InvalidIndexException` and `\Spatie\Enum\Exceptions\InvalidValueException` exceptions
- Add `\Spatie\Enum\Enum->getIndex()` method
- Add `\Spatie\Enum\Enum::getIndices()` method
- Add `\Spatie\Enum\Enum->getValue()` method
- Add `\Spatie\Enum\Enum::getValues()` method
- Rename `\Spatie\Enum\Enum::from()` to `\Spatie\Enum\Enum::make()`
- Rename `\Spatie\Enum\Enum::equals()` to `\Spatie\Enum\Enum::isEqual()`
- Rename `\Spatie\Enum\Enum::isOneOf()` to `\Spatie\Enum\Enum::isAny()`
- Change `\Spatie\Enum\Enum->__construct()` signature and responsibility - only take index & value and validate them
- Change `\Spatie\Enum\Enum::toArray()` return value instead of an array of `value => name` it returns `value => index`
- Drop recursive `\Spatie\Enum\Enum::make()` support from inside of an unstatic method
- Drop `\Spatie\Enum\Enum::$map` in favor of `\Spatie\Enum\Enum->getIndex()`and `\Spatie\Enum\Enum->getValue()`
- Update all methods have strict type checks: `index: int` and `value: string`
- Update all methods are compatible with all required types: index, value, name or instance of Enum

## 1.1.0 - 2019-03-18

- Add support for is* checks

## 1.0.2 - 2019-03-18

- Support case insensitive enum values (#13)

## 1.0.0 - 2019-02-08

- initial release
