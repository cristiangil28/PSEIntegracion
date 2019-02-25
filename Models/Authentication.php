<?php

class Authentication{

    /**
     * $login Identificador habilitado para el consumo del
     * API, entregado por Place to Pay.
     * @var String[32]
     */
    public $login;

    /**
     * $seed Semilla usada para el consumo del API en el
     * proceso del hash por SHA1 del tranKey, ISO8601.
     * @var String
     */
    public $seed;
    /**
     * $trankey Llave transaccional para el consumo del API
     * SHA1(seed + tranKey).
     * @var String[40]
     */
    public $trankey;
    /**
     * $additional Datos adicionales a la estructura de autenticación.
     * @var Attribute[]
     */
    public $additional;
}