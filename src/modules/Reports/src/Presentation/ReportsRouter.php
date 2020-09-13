<?php
namespace Rosatom\Reports\Presentation;

use Slim\App;

class ReportsRouter
{

    /**
     * ConverterRouter constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $app->get('/report', [new ReportsController(), 'getReportFile']);
    }
}
