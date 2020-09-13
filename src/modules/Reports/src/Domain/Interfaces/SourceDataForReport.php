<?php
namespace Rosatom\Reports\Domain\Interfaces;

interface SourceDataForReport
{
    public function getData(): array;
}
