<?php
namespace Rosatom\Reports\App\Factories;

use Rosatom\Reports\App\Schemes\XMLReportScheme;
use Rosatom\Reports\Domain\Interfaces\ConverterSchema;

class SchemeFactory
{
    public static function create(string $reportType = ''): ConverterSchema
    {
        return new XMLReportScheme();
    }
}
