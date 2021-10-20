<?php

namespace Spatie\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Spatie\Enum\Enum;
use stdClass;
use TypeError;

class EnumFromTest extends TestCase
{
    /**
     * @test
     * @dataProvider unallowedTypes
     */
    public function from_will_throw_type_error_for_unallowed_value_types($value)
    {
        $this->expectException(TypeError::class);

        HttpMethod::from($value);
    }

    /** @test */
    public function from_resolves_all_allowed_value_types()
    {
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
    }

    /** @test */
    public function try_from_will_result_in_null_values()
    {
        $this->assertNull(HttpMethod::tryFrom(''));
        $this->assertNull(HttpMethod::tryFrom(false));
        $this->assertNull(HttpMethod::tryFrom(true));
        $this->assertNull(HttpMethod::tryFrom(1.0));
        $this->assertNull(HttpMethod::tryFrom(1.4));
    }

    /** @test */
    public function try_from_will_throw_type_error_for_array()
    {
        $this->expectException(TypeError::class);

        HttpMethod::tryFrom(['GET']);
    }

    /** @test */
    public function try_from_will_throw_type_error_for_object()
    {
        $this->expectException(TypeError::class);

        HttpMethod::tryFrom(new stdClass);
    }

    public function unallowedTypes(): array
    {
        return [
            [false],
            [true],
            [1.4],
            [['GET']],
            [new stdClass],
        ];
    }
}

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
