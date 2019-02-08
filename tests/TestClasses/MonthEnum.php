<?php

namespace Spatie\Enum\Tests\TestClasses;

use Spatie\Enum\Enum;

abstract class MonthEnum extends Enum
{
    abstract public function getNumericIndex(): int;

    public static function january(): MonthEnum
    {
        return new class('january') extends MonthEnum
        {
            public function getNumericIndex(): int
            {
                return 1;
            }
        };
    }

    public static function february(): MonthEnum
    {
        return new class('february') extends MonthEnum
        {
            public function getNumericIndex(): int
            {
                return 2;
            }
        };
    }

    public static function march(): MonthEnum
    {
        return new class('march') extends MonthEnum
        {
            public function getNumericIndex(): int
            {
                return 3;
            }
        };
    }

    public static function april(): MonthEnum
    {
        return new class('april') extends MonthEnum
        {
            public function getNumericIndex(): int
            {
                return 4;
            }
        };
    }

    public static function may(): MonthEnum
    {
        return new class('may') extends MonthEnum
        {
            public function getNumericIndex(): int
            {
                return 5;
            }
        };
    }

    public static function june(): MonthEnum
    {
        return new class('june') extends MonthEnum
        {
            public function getNumericIndex(): int
            {
                return 6;
            }
        };
    }

    public static function july(): MonthEnum
    {
        return new class('july') extends MonthEnum
        {
            public function getNumericIndex(): int
            {
                return 7;
            }
        };
    }

    public static function august(): MonthEnum
    {
        return new class('august') extends MonthEnum
        {
            public function getNumericIndex(): int
            {
                return 8;
            }
        };
    }

    public static function september(): MonthEnum
    {
        return new class('september') extends MonthEnum
        {
            public function getNumericIndex(): int
            {
                return 9;
            }
        };
    }

    public static function october(): MonthEnum
    {
        return new class('october') extends MonthEnum
        {
            public function getNumericIndex(): int
            {
                return 10;
            }
        };
    }

    public static function november(): MonthEnum
    {
        return new class('november') extends MonthEnum
        {
            public function getNumericIndex(): int
            {
                return 11;
            }
        };
    }

    public static function december(): MonthEnum
    {
        return new class('december') extends MonthEnum
        {
            public function getNumericIndex(): int
            {
                return 12;
            }
        };
    }
}
