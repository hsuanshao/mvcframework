<?php 
    namespace core;

    class generalReturnStruct {
        private $array;
        private $err;

        public function __construct(?array $inputArr, ?string $err){
            $this->array = $inputArr;
            $this->err   = $err;
        }

        public function Result():?array{
            return $this->array;
        }

        public function Error():?string{
            return $this->err;
        }
    }