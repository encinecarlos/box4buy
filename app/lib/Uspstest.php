<?php

namespace App\lib;

use Illuminate\Http\Request;
use USPS\RatePackage;

class UspsTest
{
    public static function calculate(Request $request)
    {
        $rate = new \USPS\Rate(getenv('USPS_USER'));
        $rate->setInternationalCall(true);
        $rate->addExtraOption('Revision', 2);
        $package = new RatePackage;
        $package->setPounds($request->peso);
        $package->setOunces(0);
        $package->setField('Machinable', 'True');
        $package->setField('MailType', 'Package');
        $package->setField('ValueOfContents', array(
                           'POBoxFlag' => 'N',
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
        //$package->setField('AcceptanceDateTime', '2018-07-05T13:15:00-06:00');
        //$package->setField('DestinationPostalCode', '95590000');
        // add the package to the rate stack
        $rate->addPackage($package);
        // Perform the request and print out the result
        $rate->getRate();
        $response = $rate->getArrayResponse();

        $data = [];
        $servicos = $response["IntlRateV2Response"]["Package"]["Service"];
        $taxabox = 0;
        
        for ($i = 0; $i < count($servicos); $i++) {
            if ($servicos[$i]['@attributes']['ID'] == 1) {                
                $taxabox = number_format(12, 2);
            }
            elseif($servicos[$i]['@attributes']['ID'] == 2) {                
                $taxabox = number_format(7.5, 2);
            }
            elseif($servicos[$i]['@attributes']['ID'] == 15) {                
                $taxabox = number_format(3, 2);                    
            }

            $valortotal = $servicos[$i]["Postage"] + $taxabox;
            
            $taxa = ($valortotal / 100) * 5;
            $valorfinal = $valortotal + $taxa;
            
            array_push($data, [
                'id' => $servicos[$i]['@attributes']['ID'],
                'peso' => $request->peso,
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
}
