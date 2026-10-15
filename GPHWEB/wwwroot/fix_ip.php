<?php
include "config.php";
$sql = "UPDATE server SET 
    gameipdx = '127.0.0.1', 
    gameipwt = '127.0.0.1', 
    resdx = 'http://127.0.0.1:81/', 
    reswt = 'http://127.0.0.1:81/', 
    mysqlip = '127.0.0.1' 
    WHERE id > 0";
$res = mysql_query($sql);
if($res) {
    echo "OK: Da cap nhat IP ve 127.0.0.1 thanh cong!";
} else {
    echo "ERROR: " . mysql_error();
}
?>

