<?php 
    // specific url config
    define("ENV", "dev");
    define("CURRENT_SUB_DOMAIN", "www");
    define("STOREMODE", "mode1");
    define("DBName", "store");
    
    // Load enviroment config file
    include __DIR__."/".ENV.".php";
