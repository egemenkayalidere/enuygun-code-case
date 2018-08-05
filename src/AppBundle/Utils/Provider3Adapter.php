<?php

namespace AppBundle\Utils;

use AppBundle\Model\CurrencyCompareAdapter;

class Provider3Adapter implements CurrencyCompareAdapter
{
    private $provider3;

    public function __construct(Provider3 $provider3)
    {
        $this->provider3 = $provider3;
    }

    public function getValues()
    {
        return $this->provider3->currencyValuesOfProvider3();
    }

    public function saveToDB($values)
    {
        return $this->provider3->saveProvider3ValuesToDB_Test($values);
    }
}