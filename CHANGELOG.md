# Changelog

All notable changes to `enum` will be documented in this file

## 3.13.0 - 2022-04-22

- Drop PHP 7.4 support
- Add `Stringable` interface to enum class - [#116](https://github.com/spatie/enum/pull/116)

## 3.12.0 - 2022-02-05

- Add support for `isset()` calls to enum `->value` und `->label` - [#109](https://github.com/spatie/enum/pull/109)

## 3.12.0 - 2022-02-05

- Add support for `isset()` calls to enum `->value` und `->label` - [#109](https://github.com/spatie/enum/pull/109)

## 3.11.1 - 2021-11-25

- Change attribute for PHP 8.1 compatibility

## 3.11.0 - 2021-11-25

- Added support for PHP 8.1

## 3.10.0 - 2021-10-20

- Fix `from()` and `tryFrom()` methods to do PHP type-juggling (string to integer) - [#108](https://github.com/spatie/enum/pull/108)
- Fix `tryFrom()` method to catch scalar type-errors - [#105](https://github.com/spatie/enum/pull/105)

## 3.9.0 - 2021-05-10

- Add `from()` and `tryFrom()` methods to get closer to PHP8.1 native enums - [#94](https://github.com/spatie/enum/pull/94)
- Deprecate `make()` in favor of `from()` method - [#94](https://github.com/spatie/enum/pull/94)
- Add flyweight pattern to return the same enum instance for every call - [#94](https://github.com/spatie/enum/pull/94)

## 3.8.0 - 2021-04-12

- Add `cases()` method to retrieve all instances of the enum - [#79](https://github.com/spatie/enum/pull/79)

## 3.7.2 - 2021-03-10

- Fix problem with `@readonly` annotation and annotation parsing libraries - [#92](https://github.com/spatie/enum/pull/92)

## 3.7.1 - 2021-02-12

- Add description to PHPUnit assertion methods - [#88](https://github.com/spatie/enum/pull/88)

## 3.7.0 - 2021-01-13

- Add ability to use a `Closure` as value/label map - [#87](https://github.com/spatie/enum/pull/87)

## 3.6.4 - 2021-01-13

- Add psalm annotations to seal and lock internals - [#85](https://github.com/spatie/enum/pull/85)

## 3.6.3 - 2021-01-12

- Fix extra whitespaces in enum definition doc-blocks - [#86](https://github.com/spatie/enum/pull/86)

## 3.6.2 - 2020-12-17

- Fix issue with enums not callable within enum classes - [#82](https://github.com/spatie/enum/pull/82)

## 3.6.0 - 2020-11-26

- Add `assertIsEnumValue()` and `assertIsEnumLabel()` to `\Spatie\Enum\Phpunit\EnumAssertions` - [#80](https://github.com/spatie/enum/pull/80)

## 3.5.1 - 2020-11-19

- Fix `\Spatie\Enum\Enum` php-doc `@property-read` annotations - [#78](https://github.com/spatie/enum/pull/78)

## 3.5.0 - 2020-10-22

- Add [Faker](https://github.com/fzaninotto/Faker) provider to generate random enum instances, values and labels `\Spatie\Enum\Faker\FakerEnumProvider` - [#74](https://github.com/spatie/enum/pull/74)

## 3.4.0 - 2020-10-22

- Add `\Spatie\Enum\Enum::toValues()` and `\Spatie\Enum\Enum::toLabels()` methods - [#72](https://github.com/spatie/enum/pull/72)

## 3.3.0 - 2020-10-21

- Add `\Spatie\Enum\Phpunit\EnumAssertions` with a default set of assertions - [#71](https://github.com/spatie/enum/pull/71)

## 3.2.0 - 2020-10-08

- Support PHP ^8.0

## 3.1.2 - 2020-09-28

- Don't cast value to string when serializing to JSON - [#68](https://github.com/spatie/enum/pull/68)

## 3.1.1 - 2020-08-28

- Throw `TypeError` if value passed to `Enum` construct is not `string` or `integer`

## 3.1.0 - 2020-08-28

[#64](https://github.com/spatie/enum/pull/64)

- Add missing type-hints and doc-blocks
- Fix unique values and labels
- Flag `EnumDefinition` as internal

## 3.0.0 - 2020-07-22

- A complete overhaul of the package, all details are discussed in [the PR](https://github.com/spatie/enum/pull/56)

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
- > Please note that this could be breaking for custom implementations of the `\Spatie\Enum\Enumerable` interface.
- 
- 
- 

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
- Add `\Spatie\Enum\Enum-&amp;gt;getIndex()` method
- Add `\Spatie\Enum\Enum::getIndices()` method
- Add `\Spatie\Enum\Enum-&amp;gt;getValue()` method
- Add `\Spatie\Enum\Enum::getValues()` method
- Rename `\Spatie\Enum\Enum::from()` to `\Spatie\Enum\Enum::make()`
- Rename `\Spatie\Enum\Enum::equals()` to `\Spatie\Enum\Enum::isEqual()`
- Rename `\Spatie\Enum\Enum::isOneOf()` to `\Spatie\Enum\Enum::isAny()`
- Change `\Spatie\Enum\Enum-&amp;gt;__construct()` signature and responsibility - only take index & value and validate them
- Change `\Spatie\Enum\Enum::toArray()` return value instead of an array of `value =&amp;gt; name` it returns `value =&amp;gt; index`
- Drop recursive `\Spatie\Enum\Enum::make()` support from inside of an unstatic method
- Drop `\Spatie\Enum\Enum::$map` in favor of `\Spatie\Enum\Enum-&amp;gt;getIndex()`and `\Spatie\Enum\Enum-&amp;gt;getValue()`
- Update all methods have strict type checks: `index: int` and `value: string`
- Update all methods are compatible with all required types: index, value, name or instance of Enum

## 1.1.0 - 2019-03-18

- Add support for is* checks

## 1.0.2 - 2019-03-18

- Support case insensitive enum values (#13)

## 1.0.0 - 2019-02-08

- initial release
