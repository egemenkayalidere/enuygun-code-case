<?php

namespace AppBundle\Utils;

class FindBestCurrency
{
    public function findBestCurrency($valuesToCompare)
    {
        $dollarPrices = [];
        $euroPrices = [];
        $sterlingPrices = [];

        foreach ($valuesToCompare as $value) {
            if ($this->isSymbolValid($value->getSymbol(), 'USD') > -1) {
                $dollarPrices[] = [
                    'value' => (float)$value->getValue(),
                    'provider' => $value->getProvider(),
                    'symbol' => 'USD-TRY'
                ];
            }

            if ($this->isSymbolValid($value->getSymbol(), 'EUR') > -1) {
                $euroPrices[] = [
                    'value' => (float)$value->getValue(),
                    'provider' => $value->getProvider(),
                    'symbol' => 'EUR-TRY'
                ];
            }

            if ($this->isSymbolValid($value->getSymbol(), 'GBP') > -1) {
                $sterlingPrices[] = [
                    'value' => (float)$value->getValue(),
                    'provider' => $value->getProvider(),
                    'symbol' => 'GBP-TRY'
                ];
            }
        }

        $prices = [
            min($dollarPrices),
            min($euroPrices),
            min($sterlingPrices),
        ];

        return $prices;
    }

    private function isSymbolValid($symbol, $currency)
    {
        $dollarSymbols = ['DOLAR', 'USDTRY'];
        $euroSymbols = ['AVRO', 'EURTRY'];
        $sterlingSybols = ['İNGİLİZ STERLİNİ', 'GBPTRY'];

        if ($currency === 'USD') {
            return array_search($symbol, $dollarSymbols);
        } elseif ($currency === 'EUR') {
            return array_search($symbol, $euroSymbols);
        } elseif ($currency === 'GBP') {
            return array_search($symbol, $sterlingSybols);
        } else {
            return false;
        }
    }
}