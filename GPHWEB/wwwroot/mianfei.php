<?php
session_start();
include 'config.php';

function GetmianfeiList()
{
	$str="<p>免费领取：";
	$str=$str."<a href=\"mianfei.php?go=coin&s=[server]&roleid=[roleid]\" title=\"免费领取铜钱1000万 绑定元宝1000万\" class=\"bt_but c_1_g mr10 tips\"><u></u>免费领取铜钱1000万 绑定元宝1000万</a>";
//	$str=$str."<a href=\"mianfei.php?go=js&s=[server]&roleid=[roleid]\" title=\"领取免费元神\" class=\"bt_but c_1_g mr10 tips\"><u></u>免费元神</a>";
//	$str=$str."<a href=\"mianfei.php?go=cb&s=[server]&roleid=[roleid]\" title=\"领取免费神翼\" class=\"bt_but c_1_g mr10 tips\"><u></u>免费神翼</a>";
	$str=$str."<a href=\"mianfei.php?go=vip&s=[server]&roleid=[roleid]\" title=\"免费领取满级VIP\" class=\"bt_but c_1_g mr10 tips\"><u></u>免费领取满级VIP</a>";
//	$str=$str."<a href=\"mianfei.php?go=ptds&s=[server]&roleid=[roleid]\" title=\"\" class=\"bt_but c_1_g mr10 tips\"><u></u>免费领取满级平天大圣</a>";
	return $str."</p>";
}

/*
这是等级判断	
$levelrow=mysql_fetch_array(mysql_query("SELECT * FROM user_role WHERE user_id = '".$roleid."'"));

		if($levelrow[level]<70)
{
  echo "<meta http-equiv=\"Content-Type\" content=\"text ml; charset=utf-8\" />";
  echo "<script> alert('不够70级！');history.go(-1);</script>";
   exit;
}

加到ConnectMysqlServer  的下面
*/
if ($_GET[go]=="coin")
{
   $mf_name=$_GET[go];
   $roleid=addslashes(trim($_GET['roleid']));
   $server=addslashes(trim($_GET['s']));
   $mf_info=mysql_query($sqlr="SELECT * FROM mianfei_list WHERE roleid = '".$roleid."' and name = '".$mf_name."'");
   $mf_num=mysql_num_rows($mf_info);
    if($mf_num<1)
	{
	    ConnectMysqlServer($server);
		
		
		
				

		//echo $sqlz;

		
		$sqlz="SELECT * FROM user_role WHERE user_id = '".$roleid."'"; 
		//echo $sqlz;
		$result=mysql_query($sqlz);
		$row12=mysql_fetch_array($result);

		$sql1="SELECT * FROM role_account WHERE user_role_id = '".$row12[id]."'"; 
		//echo $sql1;
		$result=mysql_query($sql1);
		$row13=mysql_fetch_array($result);
		//var_dump($row13);
		$nowtj = $row13[tongqian] + 10000000 ;		//铜钱修改
		$nowyb = $row13[bind_lingshi] + 10000000 ;	//捆绑元宝
		
		$sql3="UPDATE role_account SET tongqian = '".$nowtj."' ,bind_lingshi = '".$nowyb."' WHERE user_role_id = '".$row12[id]."';";
		if(mysql_query($sql3)==true)
		{
		include 'config.php';
		$sql4="insert into  mianfei_list (name,roleid) VALUES ('".$mf_name."','".$roleid."')";
		mysql_query($sql4);
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('领取成功！');history.go(-1);</script>";
		exit;
		}
				
	}else{
	    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('你已经领取过了！');history.go(-1);</script>";
		exit;
	}
	

}
if ($_GET[go]=="js")
{
   $mf_name=$_GET[go];
   $roleid=addslashes(trim($_GET['roleid']));
   $server=addslashes(trim($_GET['s']));
   
   $mf_info=mysql_query($sqlr="SELECT * FROM mianfei_list WHERE roleid = '".$roleid."' and name = '".$mf_name."'");
   $mf_num=mysql_num_rows($mf_info);
    if($mf_num<1)
	{
	    ConnectMysqlServer($server);
		$levelrow=mysql_fetch_array(mysql_query("SELECT * FROM user_role WHERE user_id = '".$roleid."'"));

		if($levelrow[level]<70)
		{
		echo "<meta http-equiv=\"Content-Type\" content=\"text ml; charset=utf-8\" />";
		echo "<script> alert('不够70级！');history.go(-1);</script>";
		exit;
		}
		
		$sqlr="SELECT id FROM user_role WHERE user_id = '".$roleid."'"; 
		$result=mysql_query($sqlr);
		$row11=mysql_fetch_array($result);
		$sqlr="SELECT id,user_role_id FROM role_account WHERE user_role_id = '".$row11[id]."'"; 
		$result=mysql_query($sqlr);
		$row11=mysql_fetch_array($result);
				
		$sql3="INSERT INTO role_yuanshen VALUES ('".$row11[user_role_id]."', '10', '5', '0', '0', null, null, '1395058039', '2022-02-17 01:00:00');";
		if(mysql_query($sql3)==true)
		{
		include 'config.php';
		$sql4="insert into  mianfei_list (name,roleid) VALUES ('".$mf_name."','".$roleid."')";
		mysql_query($sql4);
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('领取成功！');history.go(-1);</script>";
		exit;
		}
				
	}else{
	    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('你已经领取过了！');history.go(-1);</script>";
		exit;
	}
	

}

if ($_GET[go]=="cb")
{
   $mf_name=$_GET[go];
   $roleid=addslashes(trim($_GET['roleid']));
   $server=addslashes(trim($_GET['s']));
   
   $mf_info=mysql_query($sqlr="SELECT * FROM mianfei_list WHERE roleid = '".$roleid."' and name = '".$mf_name."'");
   $mf_num=mysql_num_rows($mf_info);
    if($mf_num<99)
	{
	    ConnectMysqlServer($server);
		$levelrow=mysql_fetch_array(mysql_query("SELECT * FROM user_role WHERE user_id = '".$roleid."'"));

		if($levelrow[level]<5)
		{
		echo "<meta http-equiv=\"Content-Type\" content=\"text ml; charset=utf-8\" />";
		echo "<script> alert('不够5级！');history.go(-1);</script>";
		exit;
		}
		
		$sqlr="SELECT id FROM user_role WHERE user_id = '".$roleid."'"; 
		$result=mysql_query($sqlr);
		$row11=mysql_fetch_array($result);
		$sqlr="SELECT id,user_role_id FROM role_account WHERE user_role_id = '".$row11[id]."'"; 
		$result=mysql_query($sqlr);
		$row11=mysql_fetch_array($result);
					
		$sql3="INSERT INTO role_guangyi VALUES ('".$row11[user_role_id]."', '9', '0', '0', '', '', '1395058039', '', '0', '', '2022-02-17 22:25:56');";
		if(mysql_query($sql3)==true)
		{
		include 'config.php';
		$sql4="insert into  mianfei_list (name,roleid) VALUES ('".$mf_name."','".$roleid."')";
		mysql_query($sql4);
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('领取成功！');history.go(-1);</script>";
		exit;
		}
				
	}else{
	    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('你已经领取过了！');history.go(-1);</script>";
		exit;
	}
	

}


if ($_GET[go]=="vip")
{
   $mf_name=$_GET[go];
   $roleid=addslashes(trim($_GET['roleid']));
   $server=addslashes(trim($_GET['s']));
   $mf_info=mysql_query($sqlr="SELECT * FROM mianfei_list WHERE roleid = '".$roleid."' and name = '".$mf_name."'");
   $mf_num=mysql_num_rows($mf_info);
    if($mf_num<1)
	{
	    ConnectMysqlServer($server);
		$sqlr="SELECT id FROM user_role WHERE user_id = '".$roleid."'"; 
		$result=mysql_query($sqlr);
		$row11=mysql_fetch_array($result);
		$sqlr="SELECT id,user_role_id FROM role_account WHERE user_role_id = '".$row11[id]."'"; 
		$result=mysql_query($sqlr);
		$row11=mysql_fetch_array($result);
		
		$sqlq="SELECT * FROM recharge_record WHERE id = '".$row11[id]."'"; 
		$result=mysql_query($sqlq);
		$row12=mysql_fetch_array($result);
		
		$sql3="INSERT INTO recharge_record VALUES ('".$row11[id]."', '".$row11[user_role_id]."', '10', '2', '100000000', '0', '1', 'ipart', '0', 'IPLY_DU_4xy106910', '2014-02-21 10:41:40', 'fu1304', '".$roleid."', now());";
		//echo '<br>';
		$nowyb=$row12[money_num]+999999999;
		$sql5 = "UPDATE recharge_record set money_num=".$nowyb." WHERE id ='".$row11[id]."'";
		
		if(mysql_query($sql3)==true)
		{
		include 'config.php';
		$sql4="insert into  mianfei_list (name,roleid) VALUES ('".$mf_name."','".$roleid."')";
		mysql_query($sql4);
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('领取成功！');history.go(-1);</script>";
		exit;
		}
				
	}else{
	    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('你已经领取过了！');history.go(-1);</script>";
		exit;
	}
}

if ($_GET[go]=="tfds")
{
   $mf_name=$_GET[go];
   $roleid=addslashes(trim($_GET['roleid']));
   $server=addslashes(trim($_GET['s']));
   
   $mf_info=mysql_query($sqlr="SELECT * FROM mianfei_list WHERE roleid = '".$roleid."' and name = '".$mf_name."'");
   $mf_num=mysql_num_rows($mf_info);
    if($mf_num<1)
	{
	    ConnectMysqlServer($server);
		
	  	$sqls="select id from user_role where user_id = '".$roleid."'";
	     $result=mysql_query($sqls);
	$row2=mysql_fetch_array($result);
	
	$sqld="select lingshi from user_account where user_guid = '".$roleid."'";
	$result=mysql_query($sqld);
	$rowd=mysql_fetch_array($result);
	if ($rowd['lingshi']<50000)
	{
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	echo "<script> alert('元宝不足');history.go(-1);</script>";
	exit();	
	}

		$sqlz="SELECT * FROM user_role WHERE user_id = '".$roleid."'"; 
		//echo $sqlz;
		$result=mysql_query($sqlz);
		$row12=mysql_fetch_array($result);
		$sql1="SELECT * FROM role_account WHERE user_role_id = '".$row12[id]."'"; 
		//echo $sql1;
		$result=mysql_query($sql1);
		$row13=mysql_fetch_array($result);

		date_default_timezone_set('PRC');
		$srcDataStr = date("Y-m-d H:i:s");
		$uid=getUUID();
		$ES='{"tongfengdasheng1":100,"tongfengdasheng2":100,"tongfengdasheng3":100,"tongfengdasheng4":100,"tongfengdasheng5":100}';
		$bs='{"wuhun":5000}';
		$cs=$rowd['lingshi']-50000;
		$sql3="INSERT INTO role_shenjiang VALUES ('$uid','".$row12[id]."', 'sj0206', '', '0', '', '2',localtime(), '1', '5','0','0',localtime(),localtime(),'$ES','$bs',localtime());";
		$sql5="UPDATE user_account SET lingshi=".$cs." WHERE `user_guid` = '".$roleid."';";
		mysql_query($sql5);
		if(mysql_query($sql3)==true)
		{
		include 'config.php';
		$sql4="insert into  mianfei_list (name,roleid) VALUES ('".$mf_name."','".$roleid."')";
		mysql_query($sql4);

		
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('领取成功！');history.go(-1);</script>";
		exit;
		}
				
	}else{
	    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('你已经领取过了！');history.go(-1);</script>";
		exit;
	}
}


if ($_GET[go]=="qsds")
{
   $mf_name=$_GET[go];
   $roleid=addslashes(trim($_GET['roleid']));
   $server=addslashes(trim($_GET['s']));
   
   $mf_info=mysql_query($sqlr="SELECT * FROM mianfei_list WHERE roleid = '".$roleid."' and name = '".$mf_name."'");
   $mf_num=mysql_num_rows($mf_info);
    if($mf_num<1)
	{
	    ConnectMysqlServer($server);
		
	  	$sqls="select id from user_role where user_id = '".$roleid."'";
	     $result=mysql_query($sqls);
	$row2=mysql_fetch_array($result);
	
	$sqld="select lingshi from user_account where user_guid = '".$roleid."'";
	$result=mysql_query($sqld);
	$rowd=mysql_fetch_array($result);
	if ($rowd['lingshi']<50000)
	{
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	echo "<script> alert('元宝不足');history.go(-1);</script>";
	exit();	
	}

		$sqlz="SELECT * FROM user_role WHERE user_id = '".$roleid."'"; 
		//echo $sqlz;
		$result=mysql_query($sqlz);
		$row12=mysql_fetch_array($result);
		$sql1="SELECT * FROM role_account WHERE user_role_id = '".$row12[id]."'"; 
		//echo $sql1;
		$result=mysql_query($sql1);
		$row13=mysql_fetch_array($result);

		date_default_timezone_set('PRC');
		$srcDataStr = date("Y-m-d H:i:s");
		$uid=getUUID();
		$ES='{"qushendasheng1":100,"qushendasheng2":100,"qushendasheng3":100,"qushendasheng4":100,"qushendasheng5":100}';
		$cs=$rowd['lingshi']-50000;
		$sql3="INSERT INTO role_shenjiang VALUES ('$uid','".$row12[id]."', 'sj0207', '', '0', '', '2',localtime(), '1', '5','0','0',localtime(),localtime(),'$ES','$bs',localtime());";
		$sql5="UPDATE user_account SET lingshi=".$cs." WHERE `user_guid` = '".$roleid."';";
		mysql_query($sql5);
		if(mysql_query($sql3)==true)
		{
		include 'config.php';
		$sql4="insert into  mianfei_list (name,roleid) VALUES ('".$mf_name."','".$roleid."')";
		mysql_query($sql4);

		
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('领取成功！');history.go(-1);</script>";
		exit;
		}
				
	}else{
	    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('你已经领取过了！');history.go(-1);</script>";
		exit;
	}
}


if ($_GET[go]=="fhds")
{
   $mf_name=$_GET[go];
   $roleid=addslashes(trim($_GET['roleid']));
   $server=addslashes(trim($_GET['s']));
   
   $mf_info=mysql_query($sqlr="SELECT * FROM mianfei_list WHERE roleid = '".$roleid."' and name = '".$mf_name."'");
   $mf_num=mysql_num_rows($mf_info);
    if($mf_num<1)
	{
	    ConnectMysqlServer($server);
		
	  	$sqls="select id from user_role where user_id = '".$roleid."'";
	     $result=mysql_query($sqls);
	$row2=mysql_fetch_array($result);
	
	$sqld="select lingshi from user_account where user_guid = '".$roleid."'";
	$result=mysql_query($sqld);
	$rowd=mysql_fetch_array($result);
	if ($rowd['lingshi']<50000)
	{
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	echo "<script> alert('元宝不足');history.go(-1);</script>";
	exit();	
	}

		$sqlz="SELECT * FROM user_role WHERE user_id = '".$roleid."'"; 
		//echo $sqlz;
		$result=mysql_query($sqlz);
		$row12=mysql_fetch_array($result);
		$sql1="SELECT * FROM role_account WHERE user_role_id = '".$row12[id]."'"; 
		//echo $sql1;
		$result=mysql_query($sql1);
		$row13=mysql_fetch_array($result);

		date_default_timezone_set('PRC');
		$srcDataStr = date("Y-m-d H:i:s");
		$uid=getUUID();
		$ES='{"fuhaidasheng1":100,"fuhaidasheng2":100,"fuhaidasheng3":100,"fuhaidasheng4":100,"fuhaidasheng5":100}';
		$cs=$rowd['lingshi']-50000;
		$sql3="INSERT INTO role_shenjiang VALUES ('$uid','".$row12[id]."', 'sj0203', '', '0', '', '2',localtime(), '1', '5','0','0',localtime(),localtime(),'$ES','$bs',localtime());";
		$sql5="UPDATE user_account SET lingshi=".$cs." WHERE `user_guid` = '".$roleid."';";
		mysql_query($sql5);
		if(mysql_query($sql3)==true)
		{
		include 'config.php';
		$sql4="insert into  mianfei_list (name,roleid) VALUES ('".$mf_name."','".$roleid."')";
		mysql_query($sql4);

		
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('领取成功！');history.go(-1);</script>";
		exit;
		}
				
	}else{
	    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('你已经领取过了！');history.go(-1);</script>";
		exit;
	}
}

if ($_GET[go]=="htds")
{
   $mf_name=$_GET[go];
   $roleid=addslashes(trim($_GET['roleid']));
   $server=addslashes(trim($_GET['s']));
   
   $mf_info=mysql_query($sqlr="SELECT * FROM mianfei_list WHERE roleid = '".$roleid."' and name = '".$mf_name."'");
   $mf_num=mysql_num_rows($mf_info);
    if($mf_num<1)
	{
	    ConnectMysqlServer($server);
		
	  	$sqls="select id from user_role where user_id = '".$roleid."'";
	     $result=mysql_query($sqls);
	$row2=mysql_fetch_array($result);
	
	$sqld="select lingshi from user_account where user_guid = '".$roleid."'";
	$result=mysql_query($sqld);
	$rowd=mysql_fetch_array($result);
	if ($rowd['lingshi']<50000)
	{
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	echo "<script> alert('元宝不足');history.go(-1);</script>";
	exit();	
	}

		$sqlz="SELECT * FROM user_role WHERE user_id = '".$roleid."'"; 
		//echo $sqlz;
		$result=mysql_query($sqlz);
		$row12=mysql_fetch_array($result);
		$sql1="SELECT * FROM role_account WHERE user_role_id = '".$row12[id]."'"; 
		//echo $sql1;
		$result=mysql_query($sql1);
		$row13=mysql_fetch_array($result);

		date_default_timezone_set('PRC');
		$srcDataStr = date("Y-m-d H:i:s");
		$uid=getUUID();
	$ES='{"huntiandasheng1":100,"huntiandasheng2":100,"huntiandasheng3":100,"huntiandasheng4":100,"huntiandasheng5":100}';
		$cs=$rowd['lingshi']-50000;
		$sql3="INSERT INTO role_shenjiang VALUES ('$uid','".$row12[id]."', 'sj0204', '', '0', '', '2',localtime(), '1', '5','0','0',localtime(),localtime(),'$ES','$bs',localtime());";
		$sql5="UPDATE user_account SET lingshi=".$cs." WHERE `user_guid` = '".$roleid."';";
		mysql_query($sql5);
		if(mysql_query($sql3)==true)
		{
		include 'config.php';
		$sql4="insert into  mianfei_list (name,roleid) VALUES ('".$mf_name."','".$roleid."')";
		mysql_query($sql4);

		
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('领取成功！');history.go(-1);</script>";
		exit;
		}
				
	}else{
	    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('你已经领取过了！');history.go(-1);</script>";
		exit;
	}
}


if ($_GET[go]=="ysds")
{
   $mf_name=$_GET[go];
   $roleid=addslashes(trim($_GET['roleid']));
   $server=addslashes(trim($_GET['s']));
   
   $mf_info=mysql_query($sqlr="SELECT * FROM mianfei_list WHERE roleid = '".$roleid."' and name = '".$mf_name."'");
   $mf_num=mysql_num_rows($mf_info);
    if($mf_num<1)
	{
	    ConnectMysqlServer($server);
		
	  	$sqls="select id from user_role where user_id = '".$roleid."'";
	     $result=mysql_query($sqls);
	$row2=mysql_fetch_array($result);
	
	$sqld="select lingshi from user_account where user_guid = '".$roleid."'";
	$result=mysql_query($sqld);
	$rowd=mysql_fetch_array($result);
	if ($rowd['lingshi']<50000)
	{
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	echo "<script> alert('元宝不足');history.go(-1);</script>";
	exit();	
	}

		$sqlz="SELECT * FROM user_role WHERE user_id = '".$roleid."'"; 
		//echo $sqlz;
		$result=mysql_query($sqlz);
		$row12=mysql_fetch_array($result);
		$sql1="SELECT * FROM role_account WHERE user_role_id = '".$row12[id]."'"; 
		//echo $sql1;
		$result=mysql_query($sql1);
		$row13=mysql_fetch_array($result);

		date_default_timezone_set('PRC');
		$srcDataStr = date("Y-m-d H:i:s");
		$uid=getUUID();
	$ES='{"yishandasheng1":100,"yishandasheng2":100,"yishandasheng3":100,"yishandasheng4":100,"yishandasheng5":100}';
		$cs=$rowd['lingshi']-50000;
		$sql3="INSERT INTO role_shenjiang VALUES ('$uid','".$row12[id]."', 'sj0205', '', '0', '', '2',localtime(), '1', '5','0','0',localtime(),localtime(),'$ES','$bs',localtime());";
		$sql5="UPDATE user_account SET lingshi=".$cs." WHERE `user_guid` = '".$roleid."';";
		mysql_query($sql5);
		if(mysql_query($sql3)==true)
		{
		include 'config.php';
		$sql4="insert into  mianfei_list (name,roleid) VALUES ('".$mf_name."','".$roleid."')";
		mysql_query($sql4);

		
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('领取成功！');history.go(-1);</script>";
		exit;
		}
				
	}else{
	    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('你已经领取过了！');history.go(-1);</script>";
		exit;
	}
}

if ($_GET[go]=="qtds")
{
   $mf_name=$_GET[go];
   $roleid=addslashes(trim($_GET['roleid']));
   $server=addslashes(trim($_GET['s']));
   
   $mf_info=mysql_query($sqlr="SELECT * FROM mianfei_list WHERE roleid = '".$roleid."' and name = '".$mf_name."'");
   $mf_num=mysql_num_rows($mf_info);
    if($mf_num<1)
	{
	    ConnectMysqlServer($server);
		
	  	$sqls="select id from user_role where user_id = '".$roleid."'";
	     $result=mysql_query($sqls);
	$row2=mysql_fetch_array($result);
	
	$sqld="select lingshi from user_account where user_guid = '".$roleid."'";
	$result=mysql_query($sqld);
	$rowd=mysql_fetch_array($result);
	if ($rowd['lingshi']<50000)
	{
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	echo "<script> alert('元宝不足');history.go(-1);</script>";
	exit();	
	}

		$sqlz="SELECT * FROM user_role WHERE user_id = '".$roleid."'"; 
		//echo $sqlz;
		$result=mysql_query($sqlz);
		$row12=mysql_fetch_array($result);
		$sql1="SELECT * FROM role_account WHERE user_role_id = '".$row12[id]."'"; 
		//echo $sql1;
		$result=mysql_query($sql1);
		$row13=mysql_fetch_array($result);

		date_default_timezone_set('PRC');
		$srcDataStr = date("Y-m-d H:i:s");
		$uid=getUUID();
	$ES='{"qitiandasheng1":100,"qitiandasheng2":100,"qitiandasheng3":100,"qitiandasheng4":100,"qitiandasheng5":100}';
		$cs=$rowd['lingshi']-50000;
		$sql3="INSERT INTO role_shenjiang VALUES ('$uid','".$row12[id]."', 'sj0201', '', '0', '', '2',localtime(), '1', '5','0','0',localtime(),localtime(),'$ES','$bs',localtime());";
		$sql5="UPDATE user_account SET lingshi=".$cs." WHERE `user_guid` = '".$roleid."';";
		mysql_query($sql5);
		if(mysql_query($sql3)==true)
		{
		include 'config.php';
		$sql4="insert into  mianfei_list (name,roleid) VALUES ('".$mf_name."','".$roleid."')";
		mysql_query($sql4);

		
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('领取成功！');history.go(-1);</script>";
		exit;
		}
				
	}else{
	    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('你已经领取过了！');history.go(-1);</script>";
		exit;
	}
}

if ($_GET[go]=="ptds")
{
   $mf_name=$_GET[go];
   $roleid=addslashes(trim($_GET['roleid']));
   $server=addslashes(trim($_GET['s']));
   
   $mf_info=mysql_query($sqlr="SELECT * FROM mianfei_list WHERE roleid = '".$roleid."' and name = '".$mf_name."'");
   $mf_num=mysql_num_rows($mf_info);
    if($mf_num<1)
	{
	    ConnectMysqlServer($server);
		
	  	$sqls="select id from user_role where user_id = '".$roleid."'";
	     $result=mysql_query($sqls);
	$row2=mysql_fetch_array($result);
	
	$sqld="select lingshi from user_account where user_guid = '".$roleid."'";
	$result=mysql_query($sqld);
	$rowd=mysql_fetch_array($result);
	if ($rowd['lingshi']<0)
	{
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	echo "<script> alert('元宝不足');history.go(-1);</script>";
	exit();	
	}

		$sqlz="SELECT * FROM user_role WHERE user_id = '".$roleid."'"; 
		//echo $sqlz;
		$result=mysql_query($sqlz);
		$row12=mysql_fetch_array($result);
		$sql1="SELECT * FROM role_account WHERE user_role_id = '".$row12[id]."'"; 
		//echo $sql1;
		$result=mysql_query($sql1);
		$row13=mysql_fetch_array($result);

		date_default_timezone_set('PRC');
		$srcDataStr = date("Y-m-d H:i:s");
		$uid=getUUID();
	$ES='{"pingtiandasheng1":100,"pingtiandasheng2":100,"pingtiandasheng3":100,"pingtiandasheng4":100,"pingtiandasheng5":100}';
		$cs=$rowd['lingshi']-0;
		$sql3="INSERT INTO role_shenjiang VALUES ('$uid','".$row12[id]."', 'sj0202', '', '0', '', '2',localtime(), '1', '5','0','0',localtime(),localtime(),'$ES','$bs',localtime());";
		$sql5="UPDATE user_account SET lingshi=".$cs." WHERE `user_guid` = '".$roleid."';";
		mysql_query($sql5);
		if(mysql_query($sql3)==true)
		{
		include 'config.php';
		$sql4="insert into  mianfei_list (name,roleid) VALUES ('".$mf_name."','".$roleid."')";
		mysql_query($sql4);

		
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('领取成功！');history.go(-1);</script>";
		exit;
		}
				
	}else{
	    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('你已经领取过了！');history.go(-1);</script>";
		exit;
	}
}
if ($_GET[go]=="gg")
{
   $mf_name=$_GET[go];
   $roleid=addslashes(trim($_GET['roleid']));
   $server=addslashes(trim($_GET['s']));
   
   $mf_info=mysql_query($sqlr="SELECT * FROM mianfei_list WHERE roleid = '".$roleid."' and name = '".$mf_name."'");
   $mf_num=mysql_num_rows($mf_info);
    if($mf_num<1)
	{
	    ConnectMysqlServer($server);
		
	  	$sqls="select id from user_role where user_id = '".$roleid."'";
	     $result=mysql_query($sqls);
	$row2=mysql_fetch_array($result);
	
	$sqld="select lingshi from user_account where user_guid = '".$roleid."'";
	$result=mysql_query($sqld);
	$rowd=mysql_fetch_array($result);
	if ($rowd['lingshi']<150000)
	{
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	echo "<script> alert('元宝不足');history.go(-1);</script>";
	exit();	
	}

		$sqlz="SELECT * FROM user_role WHERE user_id = '".$roleid."'"; 
		//echo $sqlz;
		$result=mysql_query($sqlz);
		$row12=mysql_fetch_array($result);
		$sql1="SELECT * FROM role_account WHERE user_role_id = '".$row12[id]."'"; 
		//echo $sql1;
		$result=mysql_query($sql1);
		$row13=mysql_fetch_array($result);

		date_default_timezone_set('PRC');
		$srcDataStr = date("Y-m-d H:i:s");
		$uid=getUUID();
	$ES='{"gonggong1":100,"gonggong2":100,"gonggong3":100,"gonggong4":100,"gonggong5":100}';
		$cs=$rowd['lingshi']-150000;
		$sql3="INSERT INTO role_shenjiang VALUES ('$uid','".$row12[id]."', 'sj0210', '', '0', '', '2',localtime(), '1', '5','0','0',localtime(),localtime(),'$ES','$bs',localtime());";
		$sql5="UPDATE user_account SET lingshi=".$cs." WHERE `user_guid` = '".$roleid."';";
		mysql_query($sql5);
		if(mysql_query($sql3)==true)
		{
		include 'config.php';
		$sql4="insert into  mianfei_list (name,roleid) VALUES ('".$mf_name."','".$roleid."')";
		mysql_query($sql4);

		
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('领取成功！');history.go(-1);</script>";
		exit;
		}
				
	}else{
	    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('你已经领取过了！');history.go(-1);</script>";
		exit;
	}
}
if ($_GET[go]=="zr")
{
   $mf_name=$_GET[go];
   $roleid=addslashes(trim($_GET['roleid']));
   $server=addslashes(trim($_GET['s']));
   
   $mf_info=mysql_query($sqlr="SELECT * FROM mianfei_list WHERE roleid = '".$roleid."' and name = '".$mf_name."'");
   $mf_num=mysql_num_rows($mf_info);
    if($mf_num<1)
	{
	    ConnectMysqlServer($server);
		
	  	$sqls="select id from user_role where user_id = '".$roleid."'";
	     $result=mysql_query($sqls);
	$row2=mysql_fetch_array($result);
	
	$sqld="select lingshi from user_account where user_guid = '".$roleid."'";
	$result=mysql_query($sqld);
	$rowd=mysql_fetch_array($result);
	if ($rowd['lingshi']<150000)
	{
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	echo "<script> alert('元宝不足');history.go(-1);</script>";
	exit();	
	}

		$sqlz="SELECT * FROM user_role WHERE user_id = '".$roleid."'"; 
		//echo $sqlz;
		$result=mysql_query($sqlz);
		$row12=mysql_fetch_array($result);
		$sql1="SELECT * FROM role_account WHERE user_role_id = '".$row12[id]."'"; 
		//echo $sql1;
		$result=mysql_query($sql1);
		$row13=mysql_fetch_array($result);

		date_default_timezone_set('PRC');
		$srcDataStr = date("Y-m-d H:i:s");
		$uid=getUUID();
	$ES='{"zhurong1":100,"zhurong2":100,"zhurong3":100,"zhurong4":100,"zhurong5":100}';
		$cs=$rowd['lingshi']-150000;
		$sql3="INSERT INTO role_shenjiang VALUES ('$uid','".$row12[id]."', 'sj0208', '', '0', '', '2',localtime(), '1', '5','0','0',localtime(),localtime(),'$ES','$bs',localtime());";
		$sql5="UPDATE user_account SET lingshi=".$cs." WHERE `user_guid` = '".$roleid."';";
		mysql_query($sql5);
		if(mysql_query($sql3)==true)
		{
		include 'config.php';
		$sql4="insert into  mianfei_list (name,roleid) VALUES ('".$mf_name."','".$roleid."')";
		mysql_query($sql4);

		
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('领取成功！');history.go(-1);</script>";
		exit;
		}
				
	}else{
	    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('你已经领取过了！');history.go(-1);</script>";
		exit;
	}
}
if ($_GET[go]=="ht")
{
   $mf_name=$_GET[go];
   $roleid=addslashes(trim($_GET['roleid']));
   $server=addslashes(trim($_GET['s']));
   
   $mf_info=mysql_query($sqlr="SELECT * FROM mianfei_list WHERE roleid = '".$roleid."' and name = '".$mf_name."'");
   $mf_num=mysql_num_rows($mf_info);
    if($mf_num<1)
	{
	    ConnectMysqlServer($server);
		
	  	$sqls="select id from user_role where user_id = '".$roleid."'";
	     $result=mysql_query($sqls);
	$row2=mysql_fetch_array($result);
	
	$sqld="select lingshi from user_account where user_guid = '".$roleid."'";
	$result=mysql_query($sqld);
	$rowd=mysql_fetch_array($result);
	if ($rowd['lingshi']<150000)
	{
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	echo "<script> alert('元宝不足');history.go(-1);</script>";
	exit();	
	}

		$sqlz="SELECT * FROM user_role WHERE user_id = '".$roleid."'"; 
		//echo $sqlz;
		$result=mysql_query($sqlz);
		$row12=mysql_fetch_array($result);
		$sql1="SELECT * FROM role_account WHERE user_role_id = '".$row12[id]."'"; 
		//echo $sql1;
		$result=mysql_query($sql1);
		$row13=mysql_fetch_array($result);

		date_default_timezone_set('PRC');
		$srcDataStr = date("Y-m-d H:i:s");
		$uid=getUUID();
	$ES='{"houtu1":100,"houtu2":100,"houtu3":100,"houtu4":100,"houtu5":100}';
		$cs=$rowd['lingshi']-150000;
		$sql3="INSERT INTO role_shenjiang VALUES ('$uid','".$row12[id]."', 'sj0212', '', '0', '', '2',localtime(), '1', '5','0','0',localtime(),localtime(),'$ES','$bs',localtime());";
		$sql5="UPDATE user_account SET lingshi=".$cs." WHERE `user_guid` = '".$roleid."';";
		mysql_query($sql5);
		if(mysql_query($sql3)==true)
		{
		include 'config.php';
		$sql4="insert into  mianfei_list (name,roleid) VALUES ('".$mf_name."','".$roleid."')";
		mysql_query($sql4);

		
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('领取成功！');history.go(-1);</script>";
		exit;
		}
				
	}else{
	    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('你已经领取过了！');history.go(-1);</script>";
		exit;
	}
}
if ($_GET[go]=="xyhd")
{
   $mf_name=$_GET[go];
   $roleid=addslashes(trim($_GET['roleid']));
   $server=addslashes(trim($_GET['s']));
   
   $mf_info=mysql_query($sqlr="SELECT * FROM mianfei_list WHERE roleid = '".$roleid."' and name = '".$mf_name."'");
   $mf_num=mysql_num_rows($mf_info);
    if($mf_num<1)
	{
	    ConnectMysqlServer($server);
		
	  	$sqls="select id from user_role where user_id = '".$roleid."'";
	     $result=mysql_query($sqls);
	$row2=mysql_fetch_array($result);
	
	$sqld="select lingshi from user_account where user_guid = '".$roleid."'";
	$result=mysql_query($sqld);
	$rowd=mysql_fetch_array($result);
	if ($rowd['lingshi']<300000)
	{
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	echo "<script> alert('元宝不足');history.go(-1);</script>";
	exit();	
	}

		$sqlz="SELECT * FROM user_role WHERE user_id = '".$roleid."'"; 
		//echo $sqlz;
		$result=mysql_query($sqlz);
		$row12=mysql_fetch_array($result);
		$sql1="SELECT * FROM role_account WHERE user_role_id = '".$row12[id]."'"; 
		//echo $sql1;
		$result=mysql_query($sql1);
		$row13=mysql_fetch_array($result);

		date_default_timezone_set('PRC');
		$srcDataStr = date("Y-m-d H:i:s");
		$uid=getUUID();
	$ES='{"xuanyuanhuangdi1":100,"xuanyuanhuangdi2":100,"xuanyuanhuangdi3":100,"xuanyuanhuangdi4":100,"xuanyuanhuangdi5":100}';
		$cs=$rowd['lingshi']-300000;
		$sql3="INSERT INTO role_shenjiang VALUES ('$uid','".$row12[id]."', 'sj0200', '', '0', '', '2',localtime(), '1', '5','0','0',localtime(),localtime(),'$ES','$bs',localtime());";
		$sql5="UPDATE user_account SET lingshi=".$cs." WHERE `user_guid` = '".$roleid."';";
		mysql_query($sql5);
		if(mysql_query($sql3)==true)
		{
		include 'config.php';
		$sql4="insert into  mianfei_list (name,roleid) VALUES ('".$mf_name."','".$roleid."')";
		mysql_query($sql4);

		
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('领取成功！');history.go(-1);</script>";
		exit;
		}
				
	}else{
	    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
		echo "<script> alert('你已经领取过了！');history.go(-1);</script>";
		exit;
	}
}

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


function ConnectMysqlServer($s)
{
	$serverrow=mysql_fetch_array(mysql_query("SELECT * FROM server where id=".$s));
   if($serverrow==false)
   {
	       echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	       echo "没有这个区！";
	       exit;
	}
  $conn=mysql_connect($serverrow[mysqlip],$serverrow[mysqlname],$serverrow[mysqlpass]);
	if($conn==false)
    {
	        include 'config.php';
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('数据库连接！');history.go(-1)</script>";
      exit;
    }
    if(mysql_select_db($serverrow[mysqlroledb],$conn)==false)
     {
             include 'config.php';
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('数据库选择！');history.go(-1)</script>";
      exit;
	  }
	 mysql_query("SET @@character_set_connection=utf8,@@character_set_results=utf8,@@character_set_client=utf8"); 


}



?>