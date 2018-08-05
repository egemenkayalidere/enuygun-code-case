<?php

namespace AppBundle\Utils;

class Provider2
{
    public function currencyValuesOfProvider2()
    {
        $url = 'http://www.mocky.io/v2/5a74519d2d0000430bfe0fa0';

        $result = file_get_contents($url);

        return (json_decode($result, true));
    }

    public function saveProvider2ValuesToDB($values)
    {
        $array = [];

        foreach ($values['result'] as $value) {
            $array[] = [
                'symbol' => $value['symbol'],
                'value' => $value['amount'],
                'provider' => 'Provider2'
            ];
        }

        return $array;
    }
}