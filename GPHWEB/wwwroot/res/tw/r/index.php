
<?php

$d=dir(".");
echo $d->path.$e;
header("Content-Type: text/html; charset=gb2312");
while(false !== ($e= $d->read())) {
$e="<a href=$e target=_blank >$e</a><br>";
echo iconv('GB2312', 'UTF-8', $e);

    }
$d->close();
?> 