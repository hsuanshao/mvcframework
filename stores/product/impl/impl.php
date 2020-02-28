<?php   
    namespace stores;

    class Product implements ProductInterface {
        private $dbh;
        private $productModel;

        public function __construct(?\PDO $dbh=null){
            if ($dbh === null){
                global $dbh;
            }
            $this->dbh = $dbh;
            $this->productModel = new \stores\productModel\ProductModel($dbh);
        }

        public function List():array{
            global $logger;
            list($products, $err) = $this->productModel->GetProductList();
            if ($err !== null){
                $logger->notify("Get product list in controller error", array("err"=>$err));
                return array(null, $err);
            }

            $productList = array();
            foreach($products as $p){
                list($news, $err) = $this->NewsList($p['productID']);
                list($videos, $err) = $this->VideoList($p['productID']);
                $p["productVideos"] = $videos;
                $p['productNews'] = $news;

                $productList[] = new ProductStruct($p);
            }
            return array($productList, null);
        }

        public function InfoById(int $id):ProductStruct{
            global $logger;
            list($product, $err) = $this->productModel->GetProductInfo($id);
            if ($err !== null){
                $logger->notify("Get product info in controller error", array("err"=>$err, "id"=>$id));
                return array(null, $err); 
            }
            $ps = new ProductStruct($product);
            return array($ps, null);
        }

        public function NewsList(int $productID):array{
            list($news, $err) = $this->productModel->GetNews($productID);
            if ($err !== null){
                $logger->notify("Get product news in controller error", array("err"=>$err, "productID"=>$productID));
                return array(null, $err); 
            }

            $returnNews = array();
            foreach($news as $new){
                $returnNews[] = new ProductNewsStruct($new);
            }

            return array($returnNews, null);
        }

        public function VideoList(int $productID):array{
            global $logger;
            list($news, $err) = $this->productModel->GetVideos($productID);
            if ($err !== null){
                $logger->notify("Get product videos in controller error", array("err"=>$err, "productID"=>$productID));
                return array(null, $err); 
            }

            $returnNews = array();
            foreach($news as $new){
                $returnNews[] = new ProductNewsStruct($new);
            }

            return array($returnNews, null);
        }

        public function NewsById(int $id):ProductNewsStruct{
            global $logger;
            list($n, $err) = $this->productModel->GetNewsInfo($id);
            if ($err !== nul) {
                $logger->notify("Get product new info in controller error", array("err"=>$err, "newsID"=>$id));
                return array(null, $err); 
            }

            $newInfo = new ProductNewsStruct($n);
            return array($newInfo, null);
        }

        public function VideoById(int $id):ProductVideoStruct{
            global $logger;
            list($v, $err) = $this->productModel->GetVideoInfo($id);
            if ($err !== nul) {
                $logger->notify("Get product video info in controller error", array("err"=>$err, "videoID"=>$id));
                return array(null, $err); 
            }

            $videoinfo = new ProductVideoStruct($v);
            return array($videoinfo, null);
        }

    }