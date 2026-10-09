<?php
//*** save me as uuid.php ***
function getUUID(){
	$uuid = "";
    if (function_exists('com_create_guid')){ 
        $uuid = com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
                .substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12)
                .chr(125);// "}"
        //return $uuid;
    }
	$uuid = str_replace("{","",$uuid);
	$uuid = str_replace("}","",$uuid);
	return strtolower($uuid);
}
//list($usec, $sec) = explode(" ", microtime());
//echo ((float)$usec + (float)$sec);
//echo "<br/>";
//echo "10304523139882682857";
//echo (double)microtime()*10000;
//echo guid();
?>