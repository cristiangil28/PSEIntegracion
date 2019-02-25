<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registrar Pago</title>
    </head>
    <body>

        <form method="post" action="Models/PSE.php">
<!--            <h1>Datos de Autenticacion</h1>
            <p>Login: <input type="text" name="login" required/></p>
            <p>TranKey: <input type="text" name="trankey" required/></p>
            <p>Seed: <input type="text" name="seed" required/></p>
            <h2>Informacion Adicional: </h2>
            <p>Nombre:<input type="text" name="additionalN" /></p>
            <p>Valor:<input type="text" name="additionalV" /></p>-->
            <h1>Datos de la Transaccion</h1>
            <p></p>
            <p> Elija su banco:


            <?php
            // put your code here
            require('config.php');
            require('Models/Authentication.php');
            require('Models/Attribute.php');
            header('Content-Type: text/html; charset=ISO-8859-1');
            require_once('lib/nusoap.php');



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

            $wsdl = "https://test.placetopay.com/soap/pse/?wsdl";

            //instanciando un nuevo objeto cliente para consumir el webservice
            $client = new nusoap_client($wsdl, 'wsdl');

            $param = array('auth' => $auth);

            //llamando al método y pasándole el array con los parámetros
            $resultado = $client->call('getBankList', $param);

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
                //echo "<pre>";
                $result = $resultado['getBankListResult']['item'];
                //$bancos = new \Ds\Map();
                echo '<select name="bankcode">';
                for ($i = 0; $i < count($result); $i++) {
                    echo '<option value="'.$result[$i]['bankCode'] .'">'.$result[$i]['bankName'] .'</option>';
//                    echo $result[$i]['bankCode'] . "<br>";
//                    echo $result[$i]['bankName'] . "<br>";
//                    echo "<br>" . "<br>";
                    //$bancos->put($result[$i]['bankCode'],$result[$i]['bankName']);
                }
                echo "</select >";
                //echo "</pre>";
            }
            ?>
            </p>
            <p>Tipo de Intefaz:
            
                <select name="bankInterface">
                    <option value="0">Persona</option>
                    <option value="1">Empresa</option>
                    
                </select>
            </p>
            
            <p>Referencia de pago:<input type="text" name="reference" required/></p>
            <p>Descripcion del Pago:<input type="text" name="description" required max="255"/></p>
            <p>
                Lenguaje:
                <select name="language">
                    <option value="ES">Espanol</option>
                    <option value="EN">Ingles</option>
                    <option value="JA">Japones</option>
                </select>
            </p>
            <p>Moneda para usar para el recaudo:
              <select name="currency">
                    <option value="COP">Colombiana</option>
                    <option value="USD">Estaunidense</option>
                </select>  
            </p>
            <p>Valor a recaudar:<input type="text" name="totalAmount" required/></p>
            <p>Discriminacion del impuesto:<input type="text" name="taxAmount" required/></p>
            <p><input type="submit" /></p>
        </form>
    </body>
</html>
