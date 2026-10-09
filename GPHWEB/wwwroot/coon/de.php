<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");

include_once "../configuration/config.inc.php";
if(!$_SESSION['accountName']) exit("<script> alert('请登陆后使用！');location.href='/UserCenter/Login.php';</script>");
$area_url = array($chongzhi);
$sqlr="SELECT name,dj FROM account WHERE name='".$_SESSION['accountName']."' "; 
$result=mysql_query($sqlr,$conn);
$row8=mysql_fetch_array($result);




$sqlr="SELECT user_guid,lingshi FROM dntg.user_account WHERE user_guid = '".$_SESSION['accountName']."'"; 
$result=mysql_query($sqlr,$conn);
$row9=mysql_fetch_array($result);



$yb = $row9[lingshi]+$row8[dj];
$cz=$row8[dj]/10;
if($row8[dj]>0){
				
				$sqlr="SELECT id FROM dntg.user_role WHERE user_id = '".$_SESSION['accountName']."'"; 
				$result=mysql_query($sqlr,$conn);
				$row11=mysql_fetch_array($result);
				$sqlr="SELECT id,user_role_id FROM dntg.role_account WHERE user_role_id = '".$row11[id]."'"; 
				$result=mysql_query($sqlr,$conn);
				$row11=mysql_fetch_array($result);
				
				
				$sqlq="SELECT * FROM dntg.recharge_record WHERE id = '".$row11[id]."'"; 
				$result=mysql_query($sqlq,$conn);
				$row12=mysql_fetch_array($result);
				
				$sqlc="UPDATE dntg.user_account SET lingshi=".$yb." WHERE user_guid='".$_SESSION['accountName']."'";
				$sqlw="UPDATE account SET dj=0 WHERE name='".$row8[name]."'"; 
				
				//exit($sqlw);

				mysql_query($sqlc,$conn);
				mysql_query($sqlw,$conn);
				echo "<script> alert('兑换元宝成功！');location.href=/UserCenter/;</script>";
				if(!$row12){
					$sqla = "INSERT INTO dntg.recharge_record VALUES ('".$row11[id]."', '".$row11[user_role_id]."', '".$row8[dj]."', '2', '".$row8[dj]."', '0', '1', 'ipart', '0', 'IPLY_DU_4xy106910', '2014-02-21 10:41:40', 'fu1304', '".$_SESSION['accountName']."', '');";
				}else{
					$nowyb=$row12[money_num]+$row8[dj];
					$sqla = "UPDATE dntg.recharge_record set money_num=".$nowyb." WHERE id ='".$row11[id]."'";
					
				}
				mysql_query($sqla,$conn);
			
		
	}  
	else{
	echo "<script> alert('当前元宝不足！');location.href=/UserCenter/;</script>";
	//header("refresh:0;url=$weburl/UserCenter/");
	//echo "<br><br><input type=button onclick=location.href='$weburl/UserCenter/' value='返回会员中心' />";
mysql_close($conn);
}
?>
