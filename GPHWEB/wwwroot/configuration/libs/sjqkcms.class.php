<?php
if(!empty($modid))
{
$type="moduleid=$modid";
$modRow =dbst($accountdb,$db_prefix."modules",$type);
//$sql = "SELECT * FROM ".$db_prefix."modules";
//$modRow = mysql_query($sql);
//while($row = mysql_fetch_array($modRow))
$moduleid=$modRow[moduleid];
$modname=$modRow[name];
$issystem=$modRow[issystem];
$disabled=$modRow[disabled];
$paytype=$modRow[paytype];
$modprice=$modRow[price];
}
?>