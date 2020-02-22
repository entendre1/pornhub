<?
	include_once './api/Mobile_Detect.php';
	$detect = new Mobile_Detect();

	if ($detect->isMobile()){
		include 'mobile.php';
	}
	if (!$detect->isMobile()){
		include 'pc.php';
	}



?>