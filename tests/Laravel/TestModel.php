<?php

namespace Spatie\Enum\Tests\Laravel;

use Spatie\Enum\HasEnums;
use Illuminate\Database\Eloquent\Model;

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
