<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require('../config.php');
require('Authentication.php');
require('Attribute.php');
require('Transacction.php');
require('Person.php');
header('Content-Type: text/html; charset=ISO-8859-1');
require_once('../lib/nusoap.php');



function getBankList() {
    
}

$auth = new Authentication();
            $auth->login = $login;
//$auth->tranKey="f376f407e59e37d84ed15cc8a8cc982f29c147cb";
            $auth->seed = $seed;
            $auth->tranKey = $llave;
//$auth->seed="2019-02-24T01:02:03+01:00";
            $atributo = new Attribute();
            $atributo->name = "";
            $atributo->value = "";
            $auth->additional = array('item' => $atributo);
            //Persona que paga
            $payer=new Person();
            $payer->documentType="CC";
            $payer->document="1020";
            $payer->firstName="cristian";
            $payer->lastName="gil";
            $payer->company="PSE";
            $payer->emailAddress="cristian@gmail.com";
            $payer->address="calle 9";
            $payer->city="Medellin";
            $payer->province="Antioquia";
            $payer->country="Colombia";
            $payer->phone="890";
            $payer->mobile="310";
            $payer->postalCode="17005";
            
            //Persona receptora
            $shipping= new Person();
            $shipping->documentType="CC";
            $shipping->document="1050";
            $shipping->firstName="Octavio";
            $shipping->lastName="jaramillo";
            $shipping->company="Alcaldia";
            $shipping->emailAddress="alcaldia@gmail.com";
            $shipping->address="Avenida centro";
            $shipping->city="Medellin";
            $shipping->province="Antioquia";
            $shipping->country="Colombia";
            $shipping->phone="444";
            $shipping->mobile="320";
            $shipping->postalCode="17005";
            //Transaccion
            
            $transaction= new Transacction();
            $transaction->bankCode='1022';
            $transaction->bankInterface='0';
            $transaction->returnUrl="https://api.placetopay.com/soap/pse#createTransaction";
            $transaction->reference="intereses";
            $transaction->description="pago en mora";
            $transaction->language="ES";
            $transaction->currency="COP";
            $transaction->totalAmount=10000;
            $transaction->taxAmount=100;
            $transaction->devolutionBase=50;
            $transaction->tipAmount=40;
            $transaction->payer=$payer;
            $transaction->buyer=$payer;
            $transaction->shipping=$shipping;
            $transaction->ipAddress="192.168.20.36";
            $transaction->userAgent="CHROME";
            $transaction->additionalData=array('item'=>$atributo);
            
            $wsdl = "https://test.placetopay.com/soap/pse/?wsdl";

            //instanciando un nuevo objeto cliente para consumir el webservice
            $client = new nusoap_client($wsdl, 'wsdl');

            $param = array('auth' => $auth,'transaction'=>$transaction);

            //llamando al método y pasándole el array con los parámetros
            $resultado = $client->call('createTransaction', $param);

            if ($client->fault) { // si
                $error = $client->getError();
                if ($error) { // Hubo algun error
                    //echo 'Error:' . $error;
                    //echo 'Error2:' . $error->faultactor;
                    //echo 'Error3:' . $error;
                    echo 'Error:  ' . $client->faultstring;
                }

                die();
            } else {
                
                $result = $resultado['createTransactionResult']['PSETransactionResponse'];
                
                
                for ($i = 0; $i < $result; $i++) {
                    
                    echo $result[$i]['returnCode'] . "<br>";
//                    echo $result[$i]['bankName'] . "<br>";
//                    echo "<br>" . "<br>";
                    //$bancos->put($result[$i]['bankCode'],$result[$i]['bankName']);
                }
              
            }
            
            
