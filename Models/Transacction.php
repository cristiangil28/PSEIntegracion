<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transacction
 *
 * @author cristian
 */
class Transacction {

    //put your code here
    /**
     * $bankCode Código de la entidad financiera
     * @var string[4] 
     */
    public $bankCode;

    /**
     * $bankInterface Tipo de interfaz del banco a desplegar [0 =
     * PERSONAS, 1 = EMPRESAS]
     * @var string[1] 
     */
    public $bankInterface;

    /**
     *
     * @var String[255] 
     */
    public $returnUrl;

    /**
     *
     * @var type 
     */
    public $reference;

    /**
     *
     * @var type 
     */
    public $description;

    /**
     *
     * @var type 
     */
    public $language;

    /**
     *
     * @var type 
     */
    public $currency;

    /**
     *
     * @var type 
     */
    public $totalAmount;

    /**
     *
     * @var type 
     */
    public $taxAmount;
    /**
     *
     * @var type 
     */
    public $devolutionBase;

    /**
     *
     * @var type 
     */
    public $tipAmount;

    /**
     *
     * @var type 
     */
    public $payer;

    /**
     *
     * @var type 
     */
    public $buyer;

    /**
     *
     * @var type 
     */
    public $shipping;

    /**
     *
     * @var type 
     */
    public $ipAddress;

    /**
     *
     * @var type 
     */
    public $userAgent;

    /**
     *
     * @var type 
     */
    public $additionalData;

}
