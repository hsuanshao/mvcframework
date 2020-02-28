<?php   
    /**
     * route/Route handle url route rule
     */
    namespace route;

    class Route {
        private $_header;
        private $routes=array();
        private $stores;
        private $logger;
        private $subdomain;
        private $vistorToken;

        public function __construct(array $_header, \route\Subdomain $subdomain){
            $this->subdomain = $subdomain;
            global $logger;
            $this->logger = $logger;
        }

        /**
         * Routing registation service
         */
        public function Register(string $host, string $routePath, string $class, string $func, ?Extra $extraSet=null):string{
            list($subdomain, $err) = $this->subdomain->Name($host);
            if ($err === ErrSubDomainNotExists){
                // todo: logo error here, provide more detail for tracking issue
                $this->logger->info(ErrSubDomainNotExists, array("host"=>$host, "route path"=>$routePath, "class"=>$class, "function"=>$func, "Extra"=>$extraSet, "timeMs"=>TimeToMs()));
                exit(ErrSubDomainNotExists);
            }

            if (!isset($this->routes[$subdomain])){
                 $this->routes[$subdomain] = array();
            } 

            if(isset($this->routes[$subdomain][$routePath])){
                $this->logger->info(ErrRoutePathDuplicateRegist, array("host"=>$host, "route path"=>$routePath, "class"=>$class, "function"=>$func, "Extra"=>$extraSet, "timeMs"=>TimeToMs()));
                exit(ErrRoutePathDuplicateRegist);
            }

            $this->routes[$subdomain][$routePath]['class'] =  $class;
            $this->routes[$subdomain][$routePath]['function'] = $func;
            $this->routes[$subdomain][$routePath]['extra']  = $extraSet;

            return RegistDone;
        }

        // Generate sitemap module
        public function Sitemap():array{
            // todo: not impl
            $routes = $this->routes;
            return ErrNotImpl;
        }

        private function URIroute():string{
            $uriFullRoute = explode("?", $_SERVER['REQUEST_URI']);
            return $uriFullRoute[0];
        }

        public function parameters():array{
            $_parameter = array();
            if (isset($_GET)){
                foreach($_GET as $key=>$val){
                    $_parameter['get'][$key] = htmlspecialchars($val, ENT_QUOTES);
                }
            }

            if (isset($_POST)){
                foreach($_POST as $key=>$val){
                    $_parameter['post'][$key] = htmlspecialchars($val, ENT_QUOTES);
                }
            }

            return $_parameter;
        }

        public function header():?array{
            return $this->_header;
        }

        
        public function Display():array{
            $sub = CURRENT_SUB_DOMAIN;
            $_parameter = $this->parameters();
            $_header    = $this->_header;
            $uriRoute   = $this->URIroute();
            // check routing path exists
            if (!isset($this->routes[$sub][$uriRoute])){
                return array(null, ErrUriNotExists);
            }
            $extraRule = $this->routes[$sub][$uriRoute]['extra'];
         
            // Get vistorToken
            list($vistorToken, $err) = $this->VistorToken();
            // Cross Site Request Forgery check
            if ($extraRule!==null && $extraRule->RequestCSRF()===true && $err != null) {
                $this->logger->notify("Cross Site Request Forgery check failure", array("parameter"=>$_parameter, "header"=>$_header, "domain"=>HOST, "uriRoute"=>$uriRoute, "timeMs"=>TimeToMs()));
                header("Location:https://".MAINHOST."/error/403");
            }

            if ($vistorToken === null ){
                $vistorToken = $this->GetVistorToken();
            }
            
            // routing path request controller
            $controller = new $this->routes[$sub][$uriRoute]['class']($_parameter, $_header);
            // routing path request controller->function
            $func = $this->routes[$sub][$uriRoute]['function'];
            list($result, $err) = $controller->$func();
            if ($err != null) {
                // todo: log error here
                return array(null, $err);
            }

            return array($result, null);
        }

        // vistorToken is designed for tracking specific user active behavior 
        // and can be applied to prevent CSRF issue
        public function GetVistorToken():string{
            if (!isset($_SESSION['vistorToken'])){
                $vistorToken = hash("sha512", base64_encode(openssl_random_pseudo_bytes(32)));
                $this->vistorToken = $vistorToken;
                $_SESSION['vistorToken'] = $vistorToken;
            }
            $vistorToken = $this->vistorToken;
            
            return $vistorToken;
        }

        public function VistorToken():array{
            if (!isset($_SESSION['vistorToken'])) {
                return array(null, ErrVistorTokenNotExists);
            }
            $this->vistorToken = $_SESSION['vistorToken'];

            return array($this->vistorToken, null);
        }
    }