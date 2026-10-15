<?php
include "config.php";
$res = mysql_query("SELECT id, servername, resdx, gameipdx, loginport FROM server");
while($row = mysql_fetch_assoc($res)) {
    echo "ID: " . $row['id'] . " | Name: " . $row['servername'] . " | IP: " . $row['gameipdx'] . " | Port: " . $row['loginport'] . " | Res: " . $row['resdx'] . "\n";
}
unlink(__FILE__);
?>

