<?php
    namespace stores\productModel;
    use \PDO;

    class ProductModel {
        private $dbh;

        public function __construct(?\PDO $dbh=null){
            if ($dbh === null){
                global $dbh;
            }
            $this->dbh = $dbh;
        }


        public function GetProductList():array{
            global $logger;
            $dbh = $this->dbh;
            $sql = "SELECT productID, productHash, productName, productPrice, shortDesc, productDesc, createTimeMs, productImg FROM products ORDER BY createTimeMs DESC";
            $stmt = $dbh->prepare($sql);
            if(!$stmt->execute()){
                $logger->notify("get product list failure", array("query string"=>$sql));
                return array(null, ErrQueryFailure);
            }

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return array($result, null);
        }

        public function GetProductInfo(int $productID):array{
            global $logger;
            $dbh = $this->dbh;
            $sql = "SELECT productID, productHash, productName, productPrice, shortDesc, productDesc, createTimeMs, productImg FROM products WHERE productID=:productID";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(":productID", $productID);
            if(!$stmt->execute()){
                $logger->notify("get product info failure", array("query string"=>$sql, "queryID"=>$productID));
                return array(null, ErrQueryFailure);
            }

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return array($result[0], null);
        }

        public function GetNews(int $productID):array{
            global $logger;
            $dbh = $this->dbh;
            $sql = "SELECT id, productID, title, img, `desc`, createTimeMs FROM productNews WHERE productID=:productID ORDER BY createTimeMs DESC";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(":productID", $productID);
            if (!$stmt->execute()){
                $logger->notify("get news list failure", array("query string"=>$sql, "queryID"=>$productID));
                return array(null, ErrQueryFailure);
            }

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return array($result, null);
        }

        public function GetNewsInfo(int $id):array{
            global $logger;
            $dbh = $this->dbh;
            $sql = "SELECT id, productID, title, img, `desc`, createTimeMs FROM productNews WHERE id=:id ORDER BY createTimeMs DESC";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(":id", $id);
            if (!$stmt->execute()){
                $logger->notify("get news list failure", array("query string"=>$sql, "queryID"=>$id));
                return array(null, ErrQueryFailure);
            }

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return array($result[0], null);
        }

        public function GetVideos(int $productID):array{
            global $logger;
            $dbh = $this->dbh;
            $sql = "SELECT id, productID, title, `desc`, videoUrl, createTimeMs FROM productVideo WHERE productID=:productID ORDER BY createTimeMs DESC";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(":productID", $productID);
            if (!$stmt->execute()){
                $logger->notify("get news list failure", array("query string"=>$sql, "queryID"=>$productID));
                return array(null, ErrQueryFailure);
            }

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return array($result, null);
        }

        public function GetVideoInfo(int $id):array{
            global $logger;
            $dbh = $this->dbh;
            $sql = "SELECT id, productID, title, `desc`, videoUrl, createTimeMs FROM productVideo WHERE id=:id ORDER BY createTimeMs DESC";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(":productID", $id);
            if (!$stmt->execute()){
                $logger->notify("get news list failure", array("query string"=>$sql, "queryID"=>$id));
                return array(null, ErrQueryFailure);
            }

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return array($result, null);
        }
    }