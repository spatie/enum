<?php

namespace Spatie\Enum\Tests\Laravel;

use stdClass;
use Spatie\Enum\Exceptions\InvalidEnumError;

final class ModelEnumTest extends LaravelTestCase
{
    /** @test */
    public function it_saves_the_value_of_an_enum()
    {
        $model = TestModel::create([
            'status' => TestModelStatus::draft(),
        ]);

        $model->refresh();

        $this->assertTrue($model->status->isEqual(TestModelStatus::draft()));
    }

    /** @test */
    public function an_invalid_class_throws_an_error()
    {
        $this->expectException(InvalidEnumError::class);

        TestModel::create([
            'status' => new stdClass(),
        ]);
    }

    /** @test */
    public function an_enum_value_can_be_mapped()
    {
        $model = TestModel::create([
            'status' => TestModelStatus::archived(),
        ]);

        $this->assertEquals(
            TestModelStatus::$map['archived'],
            $model->getAttributes()['status']
        );

        $model->refresh();

        $this->assertTrue($model->status->isEqual(TestModelStatus::archived()));
    }
}
