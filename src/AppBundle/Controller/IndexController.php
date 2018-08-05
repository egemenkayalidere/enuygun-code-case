<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Currency;
use AppBundle\Utils\FindBestCurrency;
use AppBundle\Utils\Provider1;
use AppBundle\Utils\Provider1Adapter;
use AppBundle\Utils\Provider2;
use AppBundle\Utils\Provider2Adapter;
use AppBundle\Utils\Provider3;
use AppBundle\Utils\Provider3Adapter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller
{
    private $provider1;
    private $provider1Adapter;
    private $provider2;
    private $provider2Adapter;
    private $provider3;
    private $provider3Adapter;
    private $findBestCurrency;

    public function __construct
    (
        Provider1 $provider1,
        Provider1Adapter $provider1Adapter,
        Provider2 $provider2,
        Provider2Adapter $provider2Adapter,
        Provider3 $provider3,
        Provider3Adapter $provider3Adapter,
        FindBestCurrency $findBestCurrency
    )
    {
        $this->provider1 = $provider1;
        $this->provider1Adapter = $provider1Adapter;
        $this->provider2 = $provider2;
        $this->provider2Adapter = $provider2Adapter;
        $this->provider3 = $provider3;
        $this->provider3Adapter = $provider3Adapter;
        $this->findBestCurrency = $findBestCurrency;
    }

    /**
     * @Route("/", name="indexPage")
     */
    public function indexAction()
    {
        $provider1 = new Provider1Adapter(new Provider1());
        $valuesOfProvider1 = $provider1->getValues();
        self::saveToDB($provider1->saveToDB($valuesOfProvider1));

        $provider2 = new Provider2Adapter(new Provider2());
        $valuesOfProvider2 = $provider2->getValues();
        self::saveToDB($provider2->saveToDB($valuesOfProvider2));

        $provider3 = new Provider3Adapter(new Provider3());
        $valuesOfProvider3 = $provider3->getValues();
        self::saveToDB($provider3->saveToDB($valuesOfProvider3));

        $bestCurrency = new FindBestCurrency();
        $bestPrices = $bestCurrency->findBestCurrency(self::readDataFromDB());

        return $this->render('indexPage/index.html.twig', [
            'provider1' => $valuesOfProvider1,
            'provider2' => $valuesOfProvider2,
            'provider3' => $valuesOfProvider3,
            'bestPrices' => $bestPrices,
        ]);

    }

    private function saveToDB($values)
    {
        try {
            $repo = $this->getDoctrine()->getManager();
            foreach ($values as $value) {

                $item = $repo->getRepository('AppBundle:Currency')->findOneBy(
                    [
                        'symbol' => $value['symbol'],
                        'provider' => $value['provider']
                    ]
                );

                if ($item == null) {
                    $currency = new Currency();
                    $currency->setSymbol($value['symbol']);
                    $currency->setValue($value['value']);
                    $currency->setProvider($value['provider']);
                    $repo->persist($currency);
                    $repo->flush();
                } else {
                    $obj = $repo->getRepository('AppBundle:Currency')->find($item->getId());
                    $obj->setValue($value['value']);
                    $repo->flush();
                }
            }
        } catch (\Exception $e) {
            return 'Error while saving to DB';
        }

    }

    private function readDataFromDB()
    {
        try {
            $repo = $this->getDoctrine()->getRepository('AppBundle:Currency');
            return $repo->findAll();
        } catch (\Exception $e) {
            return 'Error while saving to DB';
        }
    }
}
