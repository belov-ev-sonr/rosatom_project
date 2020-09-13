<?php
namespace Rosatom\Converters\Domain\Interfaces;

use Rosatom\Reports\Domain\Interfaces\ConverterSchema;

interface Converter
{
    public function getFile(array $data);

    public function setSchema(ConverterSchema $schema): void;
}
