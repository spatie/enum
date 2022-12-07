<?php

namespace Spatie\Enum\Tests;

use Spatie\Enum\Enum;
use stdClass;
use TypeError;

test('from will throw type error for unallowed value types', function ($value) {
    expect(fn () => HttpMethod::from($value))->toThrow(TypeError::class);
})->with([false, true, 1.4, [['GET']], [new stdClass]]);

test('from resolves all allowed value types', function () {
    expect(HttpMethod::GET()->equals(HttpMethod::from('GET')))->toBeTrue();


    expect(HttpMethod::GET()->equals(HttpMethod::from(new class {
        public function __toString()
        {
            return 'GET';
        }
    })))->toBeTrue();
    expect(HttpMethod::GET()->equals(HttpMethod::from(1)))->toBeTrue();
    expect(HttpMethod::GET()->equals(HttpMethod::from('1')))->toBeTrue();
    expect(HttpMethod::GET()->equals(HttpMethod::from(new class {
        public function __toString()
        {
            return '1';
        }
    })))->toBeTrue();
});

test('try from will result in null values', function () {
    expect(HttpMethod::tryFrom(''))->toBeNull();
    expect(HttpMethod::tryFrom(false))->toBeNull();
    expect(HttpMethod::tryFrom(true))->toBeNull();
    expect(HttpMethod::tryFrom(1.0))->toBeNull();
    expect(HttpMethod::tryFrom(1.4))->toBeNull();
});

test('try from will throw type error for array', function () {
    expect(fn () => HttpMethod::tryFrom(['GET']))->toThrow(TypeError::class);
});

test('try from will throw type error for object', function () {
    expect(fn () => HttpMethod::tryFrom(new stdClass))->toThrow(TypeError::class);
});


/**
 * @method static self GET()
 * @method static self POST()
 */
class HttpMethod extends Enum
{
    protected static function values(): array
    {
        return [
            'GET' => 1,
            'POST' => 2,
        ];
    }
}
