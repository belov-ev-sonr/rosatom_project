<?php

use bupy7\xml\constructor\XmlConstructor;

class xmlConverter
{

    /**
     * xmlConverter constructor.
     */
    public function __construct()
    {
    }

    public function xmlConvert(){
        $inn = '1234567890';
        $kpp = '12345679';
        $name = 'АО "Организация Росатома"';
        $is_filial = 'го';
        $type_of_contract = 'Депозит';
        $date_of_signing = '2020-01-01';
        $date_start = '2020-01-02';
        $date_end = '2020-02-02';
        $interest_rate = '5.65';
        $currency = 'RUR';
        $amount = '10000';
        $bic_of_bank = '42202837';
        $name_of_bank= 'Банк ВТБ  (ПАО)';
        $comment = 'null';
        $AccountBalanceCurrency = 'RUR';
        $balance = '20000';
        $id_bank_account = '1234567890';


        $in = [
            [
                'tag' => 'Organizations',
                'attributes' => [
                    'INN' => $inn,
                    'KPP' => $kpp,
                    'Name' => $name,
                    'IsFilial' => $is_filial,
                ],
                'elements' => [
                    [
                        'tag' => 'Reports',
                        'attributes' => [
                            'TypeOfContract' => $type_of_contract,
                            'DateOf_Signing' => $date_of_signing,
                            'DateStart' => $date_start,
                            'DateEnd' => $date_end,
                            'InterestRate' => $interest_rate,
                            'Currency' => $currency,
                            'Amount' =>$amount,
                        ],
                    ],
                    [
                        'tag' => 'Accounts',
                        'attributes' => [
                            'BicOfBank' => $bic_of_bank,
                            'NameOfBank' => $name_of_bank,
                            'Comment' => $comment,
                            'DateEnd' => $date_end,
                            'InterestRate' => $interest_rate,
                            'AccountBalanceCurrency' => $AccountBalanceCurrency,
                            'Balance' => $balance,
                            'IdBankAccount' => $id_bank_account
                        ],
                    ],
                ],
            ],
        ];
        $request = (new XmlConstructor())->fromArray($in)->toOutput();
    }
}