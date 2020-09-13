<?php
namespace Rosatom\Converters\App\Factories;

use Rosatom\Converters\App\Services\XMLConverter;
use Rosatom\Converters\Domain\Interfaces\Converter;

class ConverterFactory
{
    public static function createConverter(string $converterType = null): Converter
    {
        return new XMLConverter();
    }
}
