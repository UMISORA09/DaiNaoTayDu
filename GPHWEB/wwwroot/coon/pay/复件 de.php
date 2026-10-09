<?php
include_once "../configuration/config.inc.php";
if(!$_SESSION['accountName']) exit("<script> alert('请登陆后使用！');location.href='/UserCenter/Login.php';</script>");
$area_url = array($chongzhi);
$sqlr="SELECT name,dj FROM account WHERE name='".$_SESSION['accountName']."' "; 
//echo $sqlr;
$result=mysql_query($sqlr,$conn);
$row8=mysql_fetch_array($result);
$cz=$row8[dj]/10;
if($row8[dj]>0){
		$ch = curl_init();
			
		$dingdan=md5(time().$_SESSION['accountName']);
		$sign=md5($dingdan);
//http://127.0.0.1:8008/charge?api_key=123456&user_id=ceshi002&server_id=999&timestamp=12123131&order_id=12212121111&wanba_oid=1213&amount=100&currency=rmb&result=1&back_send=Y&sign=29D637D7418F110EBAE78A3A9C29080C
//﻿http://127.0.0.1:8008/charge?api_key=123456&user_id=ceshi001&server_id=999&timestamp=12123131&order_id=8b2287e028cad7377573ba840f4f1b20&wanba_oid=1213&amount=10&currency=rmb&result=1&back_send=Y&sign=4c333fc4f00a5e5c1151ca24d8e98be5
//http://127.0.0.1:8008/charge?amount=111&api_key=134567890&back_send=Y&currency=rmb&order_id=7104128009ce978d959faa16ce22f148c&result=1&server_id=999&user_id=ceshi001&wanba_oid=1232451&sign=kadfkliilskermkkvsdfks
//amount=100&api_key=134567890&back_send=Y&currency=rmb&order_id=22&result=1&server_id=999&user_id=ceshi
		$message = $area_url[0]."charge?api_key=123456&user_id=".$row8[name]."&server_id=999&amp;timestamp=12123131&order_id=".$dingdan."&wanba_oid=1213&amount=".$cz."&amp;currency=rmb&result=1&back_send=Y&sign=".$sign;
		//echo $message;
		//exit();
		curl_setopt($ch, CURLOPT_URL, $message);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		$curl_result = curl_exec($ch);
		//echo $curl_result;
		curl_close($ch);
				$sqlw="UPDATE account SET dj=0 WHERE name='".$row8[name]."'"; 
				//exit($sqlw);
				mysql_query($sqlw,$conn);
				echo "<script> alert('兑换元宝成功！');location.href=/UserCenter/;</script>";
			
		
	}  
	else{
	echo "<script> alert('当前元宝不足！');location.href=/UserCenter/;</script>";
	//header("refresh:0;url=$weburl/UserCenter/");
	//echo "<br><br><input type=button onclick=location.href='$weburl/UserCenter/' value='返回会员中心' />";
mysql_close($conn);
}
?>
