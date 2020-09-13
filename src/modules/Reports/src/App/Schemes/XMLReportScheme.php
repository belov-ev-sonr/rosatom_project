<?php
namespace Rosatom\Reports\App\Schemes;

use Rosatom\Reports\Domain\Interfaces\ConverterSchema;

class XMLReportScheme implements ConverterSchema
{

    public function getSchemaByArray(array $data): array
    {
        return [
            [
                'tag' => 'Organizations',
                'attributes' => [
                    'INN' => $data['inn'],
                    'KPP' => $data['kpp'],
                    'Name' => $data['name'],
                    'IsFilial' => $data['is_filial'],
                ],
                'elements' => [
                    [
                        'tag' => 'Reports',
                        'attributes' => [
                            'TypeOfContract' => $data['type_of_contract'],
                            'DateOf_Signing' => $data['date_of_signing'],
                            'DateStart' => $data['date_start'],
                            'DateEnd' => $data['date_end'],
                            'InterestRate' => $data['interest_rate'],
                            'Currency' => $data['currency'],
                            'Amount' => $data['amount'],
                        ],
                    ],
                    [
                        'tag' => 'Accounts',
                        'attributes' => [
                            'BicOfBank' => $data['bic_of_bank'],
                            'NameOfBank' => $data['name_of_bank'],
                            'Comment' => $data['comment'],
                            'DateEnd' => $data['date_end'],
                            'InterestRate' => $data['interest_rate'],
                            'AccountBalanceCurrency' => $data['AccountBalanceCurrency'],
                            'Balance' => $data['balance'],
                            'IdBankAccount' => $data['id_bank_account']
                        ],
                    ],
                ],
            ],
        ];
    }
}
