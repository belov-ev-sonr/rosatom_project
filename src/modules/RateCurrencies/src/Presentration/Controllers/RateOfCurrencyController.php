<?php
namespace Rosatom\RateCurrencies\Presentation\Controllers;

use Rosatom\RateCurrencies\Infrastructure\Factories\RateOfCurrencyRepositoryFactory;
use Rosatom\RateCurrencies\Presentation\Presentations\RateOfCurrencyPresenter;
use Slim\Http\Request;
use Slim\Http\Response;

class RateOfCurrencyController
{
    public function getRatesOfCurrenciesList(Request $request, Response $response): Response
    {
        $date = $request->getQueryParam('date');
        $dateTime = new \DateTime($date);
        $repository = RateOfCurrencyRepositoryFactory::createRepository();
        $ratesOfCurrencies = $repository->getRateOfCurrencyByDate($dateTime);
        $presenters = [];
        foreach ($ratesOfCurrencies as $rateOfCur) {
            $presenters[] = new RateOfCurrencyPresenter($rateOfCur);
        }

        return $response->withJson($presenters);
    }
}
