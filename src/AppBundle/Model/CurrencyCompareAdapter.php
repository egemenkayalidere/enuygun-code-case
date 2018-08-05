<?php

namespace AppBundle\Model;

interface CurrencyCompareAdapter
{
    public function getValues();

    public function saveToDB($values);
}