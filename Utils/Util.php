<?php  

class Util{
	static function redirect($location, $type, $message, $data=""){
	    header("Location: $location?$type=$message&$data");
	    exit;
	}


}