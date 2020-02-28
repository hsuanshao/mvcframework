<?php   
    namespace db;
    use \PDO;

    class DB {
        private $host;
        private $userID;
        private $userPWD;
        private $dbname;

        public function __construct() {
            $this->host     = DBHOST;
            $this->userID   = DBUSER;
            $this->userPWD  = DBPWD;
            $this->dbname   = DBName;
        }

        public function Connect():?PDO{
            global $logger;
            $connecting =  'mysql:host=' . $this->host . '; dbname=' . $this->dbname.";charset=utf8mb4";
            try {
                $dbh = new PDO($connecting, $this->userID, $this->userPWD);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $dbh->setAttribute( PDO::ATTR_EMULATE_PREPARES, false);
            } catch (Exception $e) {
                $logger->error("connecting mysql database failure", array("connecting"=>$connecting, "ID"=>$this->userID, "PWD"=>$this->userPWD ));
                $result = new connectStruct(array(null, ErrConnectDBServer));
                return $result;
            }

            if (!$dbh) {
                $logger->error("connecting mysql database failure", array("connecting"=>$connecting, "ID"=>$this->userID, "PWD"=>$this->userPWD ));
                $result = new connectingStruct(array(null, ErrConnectDBServer));
                return $result;
            }

            $dbh->query("SET NAMES 'utf8mb4'");

            $result = $dbh;
            return $result;
        }
    }


