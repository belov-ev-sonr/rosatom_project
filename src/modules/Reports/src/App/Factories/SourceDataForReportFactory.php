<?php
namespace Rosatom\Reports\App\Factories;

use Rosatom\FinReport\Application\Service\SourceDataForFinReport;
use Rosatom\Reports\Domain\Interfaces\SourceDataForReport;

class SourceDataForReportFactory
{
    public static function createSourceData(): SourceDataForReport
    {
        return new SourceDataForFinReport();
    }
}
