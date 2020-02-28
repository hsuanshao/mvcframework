<?php 
    namespace core;

    class Stores {
        private $vistorToken;
        public function __construct(?string $vistorToken=null){
            $this->vistorToken = $vistorToken;
        }

        public function load(string $storeName):array{
            global $logger;
            // check store exists
            if (!is_dir(STORES.'/'.$storeName)){
                $logger->error(ErrStoresNotExists, array("store name"=>$storeName));
                return array(null, ErrStoresNotExists); 
            }

            $return = array();
            // get first layer files
            foreach(glob(STORES.'/'.$storeName.'/*.php') as $filename){
                $return[] = $filename;
            }

            // get controller implementation files
            foreach(glob(STORES.'/'.$storeName.'/impl/*.php') as $filename){
                $return[] = $filename;
            }

            // get include model files
            foreach(glob(STORES.'/'.$storeName.'/model/*.php') as $filename){
                $return[] = $filename;
            }
            foreach($return as $f){
                include($f);
            }

            return array($return, null);
        }
    }