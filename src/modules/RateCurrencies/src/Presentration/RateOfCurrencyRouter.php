<?php
namespace Rosatom\RateCurrencies\Presentation;

use Rosatom\RateCurrencies\Presentation\Controllers\RateOfCurrencyController;
use Slim\App;

class RateOfCurrencyRouter
{

    /**
     * RateOfCurrencyRouter constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $app->get('/list', [new RateOfCurrencyController(), 'getRatesOfCurrenciesList']);
    }
}
