<?php 
     /**
      * load init config
      */
    $_header  = apache_request_headers();
    require __DIR__."/conf/config.php";
    require __DIR__."/../vendor/autoload.php";

    // Sub Domain handler
    $subdomainHDL = new \route\Subdomain($subdomains);
    // Routing Service Handler
    $routeHDL     = new \route\Route($_header, $subdomainHDL);
    // System logger
    $logger       = new \Psr\Log\Logger;
    
    /**
     * Routing Register -----------------------------------------------------
     */
    $routeHDL->Register("www", "/", "\api\idx", "index");

    // Error response pages
    $routeHDL->Register("www", "/error/400", "\api\Syserror", "badRequest"); 
    $routeHDL->Register("www", "/error/401", "\api\Syserror", "unauthorized");
    $routeHDL->Register("www", "/error/402", "\api\Syserror", "paymentRequired");
    $routeHDL->Register("www", "/error/403", "\api\Syserror", "forbidden");
    $routeHDL->Register("www", "/error/404", "\api\Syserror", "notFound");
    $routeHDL->Register("www", "/error/500", "\api\Syserror", "internalServerError");
    $routeHDL->Register("www", "/error/502", "\api\Syserror", "badGateway");
                                                                         
    # 系統維修中
    $routeHDL->Register("www", "/maintain", "\api\System", "maintain"); 
                                                                             
    # outsourcing payment flow related routing
    // Craete collection order and return payment detail information
    $routeHDL->Register("api", "/collection/order", "\api\Collection", "order");
    // Request collection order payment status
    $routeHDL->Register("api", "/collection/query", "\api\Collection", "query");   


    // --------------------------------------------------------------------------
    list($view, $err) = $routeHDL->Display();
    if ($err !== null) {
      var_dump($err);
      exit;
      header("Location:https://".MAINHOST."/error/404");
      exit;
    }

    echo $view;