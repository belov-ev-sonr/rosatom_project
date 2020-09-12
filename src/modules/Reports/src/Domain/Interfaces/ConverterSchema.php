<?php
namespace Rosatom\Reports\Domain\Interfaces;

interface ConverterSchema
{
    public function getSchemaByArray(array $data): array;
}
