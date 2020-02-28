<?php 
    // specific url config
    define("ENV", "dev");               // system enviorment
    define("CURRENT_SUB_DOMAIN", "www");   // set like as specific subdomin 
    define("STOREMODE", "mode1");   // view folder name
    define("DBName", "store");   // Database name
    
    // Load enviroment config file
    include __DIR__."/".ENV.".php";
