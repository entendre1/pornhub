<?
	$DEFAULT_LANG = 'en';
	
	$SITE_LANG = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	

	switch ($SITE_LANG) {
		case 'ru':
			$j = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/front/lang/ru_RU.local' );
			break;
		case 'en':
			$j = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/front/lang/en_US.local' );
		break;
		default:
			$j = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/front/lang/en_US.local' );
		break;
	}
	$local = json_decode($j);
	function locale($name,$default,$branch = "default"){
		global $local;
		
		if ("default" == $branch){
			if (isset($local->$name)){
				return $local->$name;
			} else {
				return $default;
			}
		}else{
			if (isset($local->$branch->$name)){
				return $local->$branch->$name;
			} else {
				return $default;
			}
		}
	}
	include_once './api/Mobile_Detect.php';
	$detect = new Mobile_Detect();

	if ($detect->isMobile()){
		include 'mobile.php';
	}else{
		include 'pc.php';
	}



?>