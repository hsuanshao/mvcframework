<?php 
    /**
     * 2020-2-4:
     * Author: William
     */

    ini_set("session.cookie_httponly", 1);
    session_start();
    header("Access-Control-Allow-Origin: *");

    /**
     * load host config relaed file
     */
    define("HOST", $_SERVER['HTTP_HOST']);
    define("MAINHOST", $_SERVER['SERVER_NAME']);
    if (isset($_SERVER['HTTP_REFERER'])){
        define("REFERER", $_SERVER['HTTP_REFERER']);
    }
    
    include __DIR__."/host/".HOST.".php";

    /**
     * Define Global parameter
     */
    define("CLOSEWEB", false);   // set website into maintenance mode
    define("ROOT", __DIR__."/../..");   // project root path
    define("CORE", ROOT."/core");       // core application path
    define("STORES", ROOT."/stores");   // customize application path, main program logic is located here
    define("VIEW", ROOT."/web.view");   // server side reder web view path
    define("APIS", ROOT."/apis");       // route application path, here should not contain with program logic

    $slackChannel = array(
        // "slack channel name" => "hooks slack bot url address"
        "emergency" => "",
        "notify"    => "",
        "error"     => "",
        "info"      => "",      
    );

    define("slackCHANNELS", $slackChannel);

    /**
     *  avaliable subdomain array 
     */
    $subdomains = array("www","api"); 
    