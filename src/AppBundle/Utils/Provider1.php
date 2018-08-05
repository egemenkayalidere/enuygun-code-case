<?php

namespace AppBundle\Utils;

class Provider1
{
    public function currencyValuesOfProvider1()
    {
        $url = 'http://www.mocky.io/v2/5a74524e2d0000430bfe0fa3';

        $result = file_get_contents($url);

        return (json_decode($result, true));
    }

    public function saveProvider1ValuesToDB($values)
    {
        $array = [];

        foreach ($values as $value) {
            $array[] = [
                'symbol' => $value['kod'],
                'value' => $value['oran'],
                'provider' => 'Provider1'
            ];
        }

        return $array;
    }
}