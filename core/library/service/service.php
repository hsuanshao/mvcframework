<?php 
    /**
     * controller service register class
     */
    /**
     * load entire store module into here
     */
    

    namespace core;
    use \SYS;

    class Service{
        private $requestService;
        private $parameters;

        public function __construct(string $requestServices, array $parameters){
            $this->requestService = $requestService;
            $this->parameters     = $parameters;
        }
        
        
    }