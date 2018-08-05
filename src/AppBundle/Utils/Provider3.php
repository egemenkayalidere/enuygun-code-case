<?php

namespace AppBundle\Utils;

class Provider3
{
    public function currencyValuesOfProvider3()
    {
        $jsonData = [
            [
                "symbol" => "USDTRY",
                "amount" => 4.20
            ],
            [
                "symbol" => "EURTRY",
                "amount" => 4.6730
            ],
            [
                "symbol" => "GBPTRY",
                "amount" => 4.99
            ]
        ];

        return $jsonData;
    }

    public function saveProvider3ValuesToDB_Test($values)
    {
        $array = [];

        foreach ($values as $value) {
            $array[] = [
                'symbol' => $value['symbol'],
                'value' => $value['amount'],
                'provider' => 'Provider3'
            ];
        }

        return $array;
    }
}