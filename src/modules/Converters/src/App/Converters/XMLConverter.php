<?php
namespace Rosatom\Converters\App\Services;

use bupy7\xml\constructor\XmlConstructor;
use Rosatom\Converters\Domain\Interfaces\Converter;
use Rosatom\Reports\Domain\Interfaces\ConverterSchema;

class XMLConverter implements Converter
{

    /** @var ConverterSchema */
    private $schema;

    /**
     * @return ConverterSchema
     * @throws \Exception
     */
    private function getSchema(): ConverterSchema
    {
        if (is_null($this->schema)) {
            throw new \Exception('Undefined schema convert. Need inject schema convert');
        }
        return $this->schema;
    }

    /**
     * @param ConverterSchema $schema
     */
    public function setSchema(ConverterSchema $schema): void
    {
        $this->schema = $schema;
    }

    public function getFile(array $data)
    {
        $dataConverted = $this->getSchema()->getSchemaByArray($data);
        $result = $this->buildXml($dataConverted);
        return $result;
    }

    private function buildXml(array $data): string
    {
        $constructor = new XmlConstructor();
        return $constructor->fromArray($data)->toOutput();
    }
}
