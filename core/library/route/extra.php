<?php 
    namespace route;

    /**
     * This class responses to handle extra processing to Register routing path
     **/
    class Extra{
        private $CSRF=true;
        private $jwtToken=false;

        public function __construct(bool $csrfchk, bool $needtransaction, bool $jwtToken){
            $this->CSRF = $csrfchk;
            $this->jwtToken = $jwtToken;
        }

        public function RequestCSRF():bool{
            return $this->CSRF;
        }

        public function JWTRequest():bool{
            return $this->jwtToken;
        }

    }