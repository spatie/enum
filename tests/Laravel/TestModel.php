<?php

namespace Spatie\Enum\Tests\Laravel;

use Illuminate\Database\Eloquent\Model;
use Spatie\Enum\HasEnums;

/**
 * @property \Spatie\Enum\Tests\Laravel\TestModelStatus status
 *
 * @method static self create(array $properties)
 */
final class TestModel extends Model
{
    use HasEnums;

    protected $enums = [
        'status' => TestModelStatus::class,
    ];

    protected $guarded = [];

    protected $table = 'test';
}
