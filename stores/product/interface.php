<?php   
    namespace stores;

    interface ProductInterface {
        public function List():array;
        
        public function InfoById(int $id):ProductStruct;

        public function NewsList(int $productID):array;

        public function VideoList(int $productId):array;

        public function NewsById(int $id):ProductNewsStruct;

        public function VideoById(int $id):ProductVideoStruct;
    }