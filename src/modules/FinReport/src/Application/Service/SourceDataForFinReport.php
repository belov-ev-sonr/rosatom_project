<?php
namespace Rosatom\FinReport\Application\Service;

use Rosatom\FinReport\Application\Service\FinReportCRUD\FinReportCRUD;
use Rosatom\Reports\Domain\Interfaces\SourceDataForReport;

class SourceDataForFinReport implements SourceDataForReport
{
    /** @var FinReportCRUD */
    private $finReportCrud;

    /**
     * SourceDataForFinReport constructor.
     * @param FinReportCRUD $finReportCrud
     */
    public function __construct(FinReportCRUD $finReportCrud = null)
    {
        if (is_null($finReportCrud)) {
            $this->finReportCrud = new FinReportCRUD();
        } else {
            $this->finReportCrud = $finReportCrud;
        }
    }

    /**
     * @return FinReportCRUD
     */
    private function getFinReportCrud(): FinReportCRUD
    {
        return $this->finReportCrud;
    }

    public function getData(): array
    {
        return $this->getFinReportCrud()->readFinReports();
    }
}
