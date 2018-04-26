<?php

	//initialize all known devices as false
$iPod = false;
$iPhone = false;
$iPad = false;
$iOS = false;
$webOSPhone = false;
$webOSTablet = false;
$webOS = false;
$BlackBerry9down = false;
$BlackBerry10 = false;
$RimTablet = false;
$BlackBerry = false;
$NokiaSymbian = false;
$Symbian = false;
$AndroidTablet = false;
$AndroidPhone = false;
$Android = false;
$WindowsPhone = false;
$WindowsTablet = false;
$Windows = false;
$Tablet = false;
$Phone = false;

	if(stripos($_SERVER['HTTP_USER_AGENT'],"iPod")){
		$iPod = true;
		$Phone = true;
		$iOS = true;
	}
	
	if(stripos($_SERVER['HTTP_USER_AGENT'],"iPhone")){
		$iPhone = true;
		$Phone = true;
		$iOS = true;
	}
	
	if(stripos($_SERVER['HTTP_USER_AGENT'],"iPad")){
		$iPad = true;
		$Tablet = true;
		$iOS = true;
	}
	
	if(stripos($_SERVER['HTTP_USER_AGENT'],"webOS")){
	
		$webOS = true;
	
		if(stripos($_SERVER['HTTP_USER_AGENT'],"Pre") || stripos($_SERVER['HTTP_USER_AGENT'],"Pixi")){
			$webOSPhone = true;
			$Phone = true;
		}
		if(stripos($_SERVER['HTTP_USER_AGENT'],"TouchPad")){
			$webOSTablet = true;
			$Tablet = true;
		}
	}
	
	if(stripos($_SERVER['HTTP_USER_AGENT'],"BlackBerry")){
		$BlackBerry = true;
		$BlackBerry9down = true;
		$Phone = true;
	}
	
	if(stripos($_SERVER['HTTP_USER_AGENT'],"BB10")){
		$BlackBerry = true;
		$BlackBerry10 = true;
		$Phone = true;
	}
	
	if(stripos($_SERVER['HTTP_USER_AGENT'],"RIM Tablet")){
		$BlackBerry = true;
		$RimTablet = true;
		$Tablet = true;
	}
	
	if(stripos($_SERVER['HTTP_USER_AGENT'],"SymbianOS")){
		$Symbian = true;
		$NokiaSymbian = true;
		$Phone = true;
	}
	
	if(stripos($_SERVER['HTTP_USER_AGENT'],"Android")){
	
		$Android = true;
	
		if(stripos($_SERVER['HTTP_USER_AGENT'],"mobile")){
			$AndroidPhone = true;
			$Phone = true;
		}else{
			$AndroidTablet = true;
			$Tablet = true;
		}
	}
	
	if(stripos($_SERVER['HTTP_USER_AGENT'],"Windows")){
	
		$Windows = true;
	
		if(stripos($_SERVER['HTTP_USER_AGENT'],"Touch")){
			$WindowsTablet = true;
			$Tablet = true;
		}
		if(stripos($_SERVER['HTTP_USER_AGENT'],"Windows Phone")){
			$WindowsPhone = true;
			$Phone = true;
		}
	}
?>
