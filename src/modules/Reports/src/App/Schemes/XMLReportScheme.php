<?php
namespace Rosatom\Reports\App\Schemes;

use Rosatom\Reports\Domain\Interfaces\ConverterSchema;

class XMLReportScheme implements ConverterSchema
{

    public function getSchemaByArray(array $data): array
    {
        $reportsRows = [];
        foreach ($data as $row) {
            $reportsRows[] = $this->getRow($row);
        }
        return $reportsRows;
    }

    private function getRow(array $row): array
    {
        return [
            'tag' => 'Organizations',
            'attributes' => [
                'INN' => $row['inn'],
                'KPP' => $row['kpp'],
                'Name' => $row['name'],
                'IsFilial' => $row['is_filial'],
            ],
            'elements' => [
                [
                    'tag' => 'Reports',
                    'attributes' => [
                        'TypeOfContract' => $row['type_of_contract'],
                        'DateOf_Signing' => $row['date_of_signing'],
                        'DateStart' => $row['date_start'],
                        'DateEnd' => $row['date_end'],
                        'InterestRate' => $row['interest_rate'],
                        'Currency' => $row['currency'],
                        'Amount' => $row['amount'],
                    ],
                ],
                [
                    'tag' => 'Accounts',
                    'attributes' => [
                        'BicOfBank' => $row['bic_of_bank'],
                        'NameOfBank' => $row['name_of_bank'],
                        'Comment' => $row['comment'],
                        'DateEnd' => $row['date_end'],
                        'InterestRate' => $row['interest_rate'],
                        'AccountBalanceCurrency' => $row['AccountBalanceCurrency'],
                        'Balance' => $row['balance'],
                        'IdBankAccount' => $row['id_bank_account']
                    ],
                ],
            ],
        ];
    }
}
