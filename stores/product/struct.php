<?php 
    namespace stores;
    
    class ProductStruct {
        private $proudctID;
        private $productHash;
        private $productName;
        private $proudctPrice;
        private $shortDesc;
        private $productDesc;
        private $createTimeMs;
        private $productImg;
        private $productVideos;
        private $productNews;

        public function __construct($input) {
            foreach($input as $key=>$val){
                $this->$key = $val;
            }
        }

        public function ID():int {
            return $this->productID;
        }

        public function Hash():string {
            return $this->productHash;
        }

        public function Name():string{
            return $this->productName;
        }

        public function Price():float{
            return $this->proudctPrice;
        }

        public function Shortdesc():?string{
            return $this->shortDesc;
        }

        public function Desc():?string{
            return $this->productDesc;
        }

        public function CreateTimeMs():?int{
            return $this->createTimeMs;
        }

        public function Image():?string{
            return $this->productImg;
        }

        public function Videos():?array{
            return $this->productVideos;
        }

        public function News():?array{
            return $this->proudctNews;
        }
    }

    class ProductNewsStruct {
        private $id;
        private $productID;
        private $title;
        private $img;
        private $desc;
        private $createTimeMs;

        public function __construct($input){
            foreach($input as $key=>$val){
                $this->$key = $val;
            }
        }

        public function ID():int{
            return $this->id;
        }

        public function ProductID():int{
            return $this->productID;
        }

        public function Title():string{
            return $this->title;
        }

        public function Image():?string{
            return $this->img;
        }

        public function Desc():?string{
            return $this->desc;
        }

        public function CreateTimeMs():int{
            return $this->createTimeMs;
        }
    }

    class ProductVideoStruct {
        private $id;
        private $title;
        private $desc;
        private $videoUrl;
        private $createTimeMs;

        public function __construct($input){
            foreach($input as $key=>$val){
                $this->$key = $val;
            }
        }

        public function ID():int{
            return $this->id;
        }

        public function Title():string {
            return $this->title;
        }

        public function Desc():?string{
            return $this->desc;
        }

        public function Video():string{
            return $this->videoUrl;
        }

        public function CreateTimeMs():int{
            return $this->createTimeMs;
        }
    }