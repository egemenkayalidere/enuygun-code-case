<?php

namespace AppBundle\Utils;

use AppBundle\Model\CurrencyCompareAdapter;

class Provider1Adapter implements CurrencyCompareAdapter
{
    private $provider1;

    public function __construct(Provider1 $provider1)
    {
        $this->provider1 = $provider1;
    }

    public function getValues()
    {
        return $this->provider1->currencyValuesOfProvider1();
    }

    public function saveToDB($values)
    {
        return $this->provider1->saveProvider1ValuesToDB($values);
    }
}