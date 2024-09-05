<?php
	if(! defined('ENVIRONMENT') )
	{
		$domain = strtolower($_SERVER['HTTP_HOST']);
		switch($domain) {
			case 'lucklucky.techfizone.com' : 						define('ENVIRONMENT', 'production'); 	break;
			case '' : 						define('ENVIRONMENT', 'production'); 	break;
			case '': 		define('ENVIRONMENT', 'staging'); 		break;
			default : 									define('ENVIRONMENT', 'development'); 	break;
		}
	}
?>