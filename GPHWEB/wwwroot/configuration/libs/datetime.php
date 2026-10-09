<?php
//*** save me as uuid.php ***
function getDateTime(){
	list($usec, $sec) = explode(" ", microtime());
	$dateTime = str_replace(".","",((float)$usec + (float)$sec)."");;
	
	return $dateTime;
}

//echo getDateTime();
?>