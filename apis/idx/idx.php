<?php
    namespace api;
    
    class Shop {
        private $_parameter;
        private $_header;
 
        
        public function __construct(?array $_parameter=null,?array $_header=null){
            $this->_parameter = $_parameter;
            $this->_header = $_header;
        }

        public function index(){
            global $logger;
            $storesHDL = new \core\Stores;
            list($shop, $err) = $storesHDL->load("shop");
            if ($err != null) {
                $logger->error($err, array("store module name"=>"shop"));
                header("Location::https://".MAINHOST."/error/500");
                exit;
            }

            $dbHDL = new \db\DB;
            $dbh = $dbHDL->Connect();
            list($pc, $err) = $storesHDL->load("product");
            if ($err != null) {
                $logger->error($err, array("store module name"=>"product"));
                header("Location::https://".MAINHOST."/error/500");
                exit;
            }

            $productController = new \stores\Product($dbh);
            list($products, $err) = $productController->List();
            
            if ($err !== null){
                $logger->error($err, array("get product list error"=>"location: shop index"));
                exit;
            }
            

            $layoutHDL = new \core\Layout;
            $header = $layoutHDL->View("/".STOREMODE."/header/header.php",array());
            $body   = $layoutHDL->View("/".STOREMODE."/pages/shop/index.php", array("products"=>$products));
            $footer = $layoutHDL->View("/".STOREMODE."/footer/footer.php", array());
            echo $header;
            echo $body;
            echo $footer;
        }
    }