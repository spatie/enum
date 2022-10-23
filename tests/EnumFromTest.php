<?php

namespace Spatie\Enum\Tests;

use Spatie\Enum\Enum;
use stdClass;
use TypeError;
//
//test('from will throw type error for unallowed value types', function($value) {
//    $this->expectException(TypeError::class);
//
//    HttpMethod::from($value);
//});

test('from resolves all allowed value types', function() {
    $this->assertTrue(HttpMethod::GET()->equals(HttpMethod::from('GET')));
    $this->assertTrue(HttpMethod::GET()->equals(HttpMethod::from(new class {
        public function __toString()
        {
            return 'GET';
        }
    })));
    $this->assertTrue(HttpMethod::GET()->equals(HttpMethod::from(1)));
    $this->assertTrue(HttpMethod::GET()->equals(HttpMethod::from('1')));
    $this->assertTrue(HttpMethod::GET()->equals(HttpMethod::from(new class {
        public function __toString()
        {
            return '1';
        }
    })));
});

test('try from will result in null values', function () {
    $this->assertNull(HttpMethod::tryFrom(''));
    $this->assertNull(HttpMethod::tryFrom(false));
    $this->assertNull(HttpMethod::tryFrom(true));
    $this->assertNull(HttpMethod::tryFrom(1.0));
    $this->assertNull(HttpMethod::tryFrom(1.4));
});

test('try from will throw type error for array', function () {
    $this->expectException(TypeError::class);

    HttpMethod::tryFrom(['GET']);
});

test('try from will throw type erorr for object', function () {
    $this->expectException(TypeError::class);

    HttpMethod::tryFrom(new stdClass);
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
