<?php 
    namespace core;
    use \PDO;

    class ServiceStruct {
        private $services;
        private $controller;
        private $transaction;

        public function __construct(string $serviceName, ?\PDO $transaction=NULL){
            $this->services = array(
                "shop" => "mall/shop",
                "pay" 
            );

            $this->transaction = $transaction;
        }
    }