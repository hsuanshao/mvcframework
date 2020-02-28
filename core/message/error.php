<?php 
    // Error handle message
    define("ErrNotImpl", "this is not implement yet");
    define("ErrSubDomainNotExists", "Regist SubDomain not exists");
    define("ErrRoutePathDuplicateRegist", "this route has been registed");
    define("ErrConnectDBServer", "try to connect server failure");
    define("ErrStoresNotExists", "require load stores not exists");
    define("ErrLangKeyDuplicate", "language yaml file has duplicate key define");

    define("ErrUriNotExists", "expect uri not exsits");
    define("ErrVistorTokenNotExists", "User vistorToken not exists");
    define("ErrQueryFailure", "sql query failure");
    define("ErrDomainNotExists", "the domain you typed is not exists");

    define("ErrlackOfRequirementFields", "lack of require field(s)");

    define("ErrQueryClientList", "try to get client list failure");
    define("ErrGetClientInfoByID", "get client info by clientID failure");
    define("ErrGetClientInfoByMerchantID", "get client info by merchantID failure");
    define("ErrCreateClient", "create client info failure");
    define("ErrCreateClientGetIDZero", "create client execute success, but get return id is zero");
    define("ErrModifyClient", "modify client info failure");
    define("ErrChangeClientAccessRight", "change client access right failure");