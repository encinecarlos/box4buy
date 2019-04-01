<?php

namespace App\lib;

use Illuminate\Http\Request;
use Sauladam\ShipmentTracker\ShipmentTracker;
use USPS\RatePackage;
use USPS\TrackConfirm;

class UspsTest
{
    public static function calculate(Request $request)
    {
        $peso_libra = $request->peso * 2.2046;
        $rate = new \USPS\Rate(getenv('USPS_USER'));
        $rate->setInternationalCall(true);
        $rate->addExtraOption('Revision', 2);
        $package = new RatePackage;
        $package->setPounds($peso_libra);
        $package->setOunces(0);
        $package->setField('Machinable', 'True');
        $package->setField('MailType', 'Package');
        $package->setField('ValueOfContents', array(
            '$PO$peso_libra',
            'GiftFlag' => 'N'
        ));

        $package->setField('ValueOfContents', 0);
        $package->setField('Country', 'Brazil');
        $package->setField('Container', 'RECTANGULAR');
        $package->setField('Size', 'LARGE');
        $package->setField('Width', 10);
        $package->setField('Length', 15);
        $package->setField('Height', 10);
        $package->setField('Girth', 0);
        $package->setField('OriginZip', 18701);
        $package->setField('CommercialFlag', 'N');

        // add the package to the rate stack
        $rate->addPackage($package);
        // Perform the request and print out the result
        $rate->getRate();
        $response = $rate->getArrayResponse();

        $data = [];
        $servicos = $response["IntlRateV2Response"]["Package"]["Service"];
        $taxabox = 0;

        for ($i = 0; $i < count($servicos); $i++) {
            if ($peso_libra >= 10.01) {
                $taxabox = number_format(12, 2);
            } elseif ($peso_libra >= 4.01 && $request->peso <= 10) {
                $taxabox = number_format(7.5, 2);
            } elseif ($peso_libra <= 4) {
                $taxabox = number_format(3, 2);
            }

            $valortotal = $servicos[$i]["Postage"] + $taxabox;

            $taxa = ($valortotal / 100) * 5;
            $valorfinal = $valortotal + $taxa;

            array_push($data, [
                'id' => $servicos[$i]['@attributes']['ID'],
                'peso' => $request->peso,
                'peso_libra' => number_format($peso_libra,2),
                'servico' => $servicos[$i]["SvcDescription"],
                'valor_frete' => $servicos[$i]["Postage"],
                'taxa_box' => $taxabox,
                'taxa_cartao' => '5%',
                'valor_total' => number_format($valorfinal, 2)
            ]);
        }

        unset($data[0]);

        if (session()->has('frete')) {
            session()->forget('frete');
            session()->push('frete', array_reverse($data));
        } else {
            session()->push('frete', array_reverse($data));
        }

        return $request;
    }

    public static function rastrearPacote($tracknumber)
    {
        try {
            $tracker = ShipmentTracker::get('USPS');
            $shipment = $tracker->track($tracknumber);
            $tracking = $shipment->latestEvent();
            $tracking_result = [
                'localizacao' => $tracking->getLocation(),
                'data_evento' => $tracking->getDate()->format('d/m/Y h:i:s'),
                'situacao' => $tracking->getStatus()
            ];
//        $json_response = json_encode($shipment->latestEvent());
            debugbar()->log($tracking_result);
            debugbar()->log($shipment->events());
            return json_encode($tracking_result);
        } catch (\Exception $ex) {
            $tracking_result = [
                'situacao' => 'error',
            ];

            debugbar()->error($ex->getMessage());
            return json_encode($tracking_result);
        }
    }
}
