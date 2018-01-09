<?php
    error_reporting(E_ERROR | E_PARSE);
    require_once "/home/dapps/public_html/solve/global_assets/db/medoo.php";
	require_once "/home/dapps/public_html/solve/vendor/autoload.php";
	$CONFIG["db"]["database_type"] = "mysql";
	$CONFIG["db"]["database_name"] = "dapps_solve_lucky_friday";
	$CONFIG["db"]["server"] = "localhost";
	$CONFIG["db"]["username"] = "dapps";
	$CONFIG["db"]["password"] = "admin5D";
	$CONFIG["db"]["charset"] = "utf8";
	
	$db = new medoo($CONFIG["db"]);
	
	date_default_timezone_set('Asia/Bangkok');
	
	//session
    $session_factory = new \Aura\Session\SessionFactory;
    $session = $session_factory->newInstance($_COOKIE);
    $user_sessions = $session->getSegment('Vendor\Package\ClassName');
    function extractError($errors){
        $errorString="";
        foreach ($errors as $error){
            $errorString.=' '.$error;
        }
        return $errorString;
    }
?>