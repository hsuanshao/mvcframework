<?php 
    namespace api;
    
    class Syserror {
        private $_parameter;
        private $_header;
 
        
        public function __construct(?array $_parameter=null,?array $_header=null){
        }

        public function badRequest(){
            $layoutHDL = new \core\Layout;
            $header = $layoutHDL->View("/".STOREMODE."/header/header.php",array());
            $body   = $layoutHDL->View("/".STOREMODE."/pages/error/400.php", array());
            $footer = $layoutHDL->View("/".STOREMODE."/footer/footer.php", array());
            echo $header;
            echo $body;
            echo $footer;
        }

        public function unauthorized(){
            $layoutHDL = new \core\Layout;
            $header = $layoutHDL->View("/".STOREMODE."/header/header.php",array());
            $body   = $layoutHDL->View("/".STOREMODE."/pages/error/401.php", array());
            $footer = $layoutHDL->View("/".STOREMODE."/footer/footer.php", array());
            echo $header;
            echo $body;
            echo $footer;
        }

        public function paymentRequired(){
            $layoutHDL = new \core\Layout;
            $header = $layoutHDL->View("/".STOREMODE."/header/header.php",array());
            $body   = $layoutHDL->View("/".STOREMODE."/pages/error/402.php", array());
            $footer = $layoutHDL->View("/".STOREMODE."/footer/footer.php", array());
            echo $header;
            echo $body;
            echo $footer;
        }

        public function forbidden(){
            $layoutHDL = new \core\Layout;
            $header = $layoutHDL->View("/".STOREMODE."/header/header.php",array());
            $body   = $layoutHDL->View("/".STOREMODE."/pages/error/403.php", array());
            $footer = $layoutHDL->View("/".STOREMODE."/footer/footer.php", array());
            echo $header;
            echo $body;
            echo $footer;
        }

        public function notFound(){
            $layoutHDL = new \core\Layout;
            $header = $layoutHDL->View("/".STOREMODE."/header/header.php",array());
            $body   = $layoutHDL->View("/".STOREMODE."/pages/error/404.php", array());
            $footer = $layoutHDL->View("/".STOREMODE."/footer/footer.php", array());
            echo $header;
            echo $body;
            echo $footer;
        }

        public function internalServerError(){
            $layoutHDL = new \core\Layout;
            $header = $layoutHDL->View("/".STOREMODE."/header/header.php",array());
            $body   = $layoutHDL->View("/".STOREMODE."/pages/error/500.php", array());
            $footer = $layoutHDL->View("/".STOREMODE."/footer/footer.php", array());
            echo $header;
            echo $body;
            echo $footer;
        }

        public function badGateWay(){
            $layoutHDL = new \core\Layout;
            $header = $layoutHDL->View("/".STOREMODE."/header/header.php",array());
            $body   = $layoutHDL->View("/".STOREMODE."/pages/error/502.php", array());
            $footer = $layoutHDL->View("/".STOREMODE."/footer/footer.php", array());
            echo $header;
            echo $body;
            echo $footer;
        }
    }