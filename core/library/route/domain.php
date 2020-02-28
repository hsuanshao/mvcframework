<?php 
    namespace route;

    /**
     * management system subdomain regist 
     */

    class Subdomain {
        private $subdomain;

        public function __construct(array $subdomain){
            foreach($subdomain as $sub) {
                $this->subdomain[\strtolower($sub)] = \strtolower($sub);
            }
        }

        public function Name(string $type):array {
            if (!array_key_exists(strtolower($type), $this->subdomain)){
                return array(null, ErrDomainNotExists);
            }
    
            return array($this->subdomain[strtolower($type)], null);
        }
    }