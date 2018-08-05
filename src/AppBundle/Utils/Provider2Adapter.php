<?php

namespace AppBundle\Utils;

use AppBundle\Model\CurrencyCompareAdapter;

class Provider2Adapter implements CurrencyCompareAdapter
{
    private $provider2;

    public function __construct(Provider2 $provider2) {
        $this->provider2 = $provider2;
    }

    public function getValues()
    {
        return $this->provider2->currencyValuesOfProvider2();
    }

    public function saveToDB($values)
    {
        return $this->provider2->saveProvider2ValuesToDB($values);
    }
}