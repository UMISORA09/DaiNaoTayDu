<?php
include 'getfunction.php';
include 'sysconfig.php';
ckcookie();

if($GLOBALS["gcook"]==0)
{
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	  echo "<script>location.href='login.php'</script>";
	  exit;
}
$thispage=3;



function GetUserList()
{
	$str1= "<select name=\"serverandrole\" id=\"role3\" style=\"width:115px;\">";
	$str3="</select>";
	    
	    $serverinfo =mysql_query("SELECT * FROM server");
	    $servernum=mysql_num_rows($serverinfo);
	    for($i=0;$i<$servernum;$i++)
	    {
		include 'config.php';
	    $serverrow=mysql_fetch_array($serverinfo);
		
		$playerinfo=mysql_query("SELECT * FROM roleid WHERE namemd5id='". $GLOBALS["gnamemd5id"]."' and serverid='".$serverrow[id]."'");
		$num1=mysql_num_rows($playerinfo);
		
        $conn=mysql_connect($serverrow[mysqlip],$serverrow[mysqlname],$serverrow[mysqlpass]);
	    if($conn==false)
        {
		   // include 'config.php';
           // return "连接数据库失败！请检查”".$serverrow[servername]."“的数据库配置信息!";
            //exit;
			continue;
        }
        if(mysql_select_db($serverrow[mysqlroledb],$conn)==false)
         {
           //  include 'config.php';
           //  return "选择角色数据库失败!请检查”".$serverrow[servername]."“的数据库配置信息!";
           //  exit;
		   continue;
		}
         mysql_query("SET @@character_set_connection=utf8,@@character_set_results=utf8,@@character_set_client=utf8");
		 for($ii=0;$ii<$num1;$ii++)
       {
	   $playerrow=mysql_fetch_array($playerinfo);
	   $roleinfo=mysql_query("SELECT * FROM user_role WHERE user_id='". $playerrow["roleid"]."'");
		$numrole=mysql_num_rows($roleinfo);
		if($numrole==0)
		{
		continue;
		}else
		{
		    $rolerow=mysql_fetch_array($roleinfo);
			$str1=$str1."<option value=\"".$serverrow[id].":".$playerrow["roleid"]."\">".$serverrow[servername].":".$rolerow[name]."</option>";
		}
		}
	}
		include 'config.php';
		return $str1= $str1.$str3;
}

function GetMoney()
{
       $moneyinfo = mysql_fetch_array(mysql_query("SELECT * FROM account WHERE name='".$GLOBALS["gname"]."'"));
	   return $moneyinfo;
}
$moneyinfo=GetMoney();
$userlist=GetUserList();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>
我要兑换-<?=$webname;?>
</title>
<link href="css/BasicStyle.css" type="text/css" rel="stylesheet" />
<script src="js/jquery.min.js" type="text/javascript" charset="UTF-8"></script></head>

<body id="loadding">

<?php
	require "header.php";
?>

    <div class="center clearfix mt10">

        <div class="c_main">

<?php
	require "user_left.php";
?>

<div class="center_right ml10">

<?php
$duihuaninfo=mysql_query("SELECT * FROM duihuan WHERE kaifang=1 and id>9");
$num=mysql_num_rows($duihuaninfo);
$str="";
if($num>0)
{
$str="<div class=\"mybox\">
        <div class=\"mytit\">
            给游戏内角色充值元宝
        </div>
		   ";
$str1="";
for($i=0;$i<$num;$i++)
{
   $row=mysql_fetch_array($duihuaninfo);
   $tem1=explode("to",$row[duihuan]);
   $tem3=$tem1;
   $tem2=explode(":",$row[bili]);
   
   $tem1[0]=Getshoptype($tem1[0]);
   $tem1[1]=Getshoptype($tem1[1]);
   $str=$str."<div class=\"con clearfix\"><form action=\"Action.php\" method=\"post\" ><p style=\"margin-bottom:10px;\">".$tem1[0]."换".$tem1[1]."的比例是:".$tem2[0].":".(int)($tem2[1]*1)."(".$tem2[0].$tem1[0]."换".(int)($tem2[1]*1)."个".$tem1[1].")"."</p>花费<input type=\"text\" name=\"dhs\" id=\"dhnum\" width=\"100px\">".$tem1[0]."给角色".$userlist."充值元宝.<INPUT type=\"hidden\" value=\"".$row[id]."\" name=\"dhid\"><INPUT type=\"hidden\" value=\"duihuan_gold\" name=\"go\"><input type=\"submit\" class=\"btn80_1\" name=\"Submit\" id=\"submit\" value=\"充值\"><font color=\"#FF0000\">(您拥有".$moneyinfo[$tem3[0]].$tem1[0].")</font></form></div>";

}
echo $str."</div>";
}
?>

<?php
$duihuaninfo=mysql_query("SELECT * FROM duihuan WHERE kaifang='1' and id<10");
$num=mysql_num_rows($duihuaninfo);
$str="";
if($num>0)
{
$str="<div class=\"mybox\">
        <div class=\"mytit\">
             站内兑换
        </div>
		   ";

$str1="";
for($i=0;$i<$num;$i++)
{
   $row=mysql_fetch_array($duihuaninfo);
   $tem1=explode("to",$row[duihuan]);
   $tem3=$tem1;
   $tem2=explode(":",$row[bili]);
   $tem1[0]=Getshoptype($tem1[0]);
   $tem1[1]=Getshoptype($tem1[1]);
   $str=$str."<div class=\"con clearfix\"><form action=\"Action.php\" method=\"post\" ><p style=\"margin-bottom:10px;\">".$tem1[0]."换".$tem1[1]."的比例是".$row[bili]."(".$tem2[0].$tem1[0]."换".$tem2[1]."个".$tem1[1].")"."</p>使用<input type=\"text\" name=\"dhs\" id=\"dhnum\" width=\"100px\">".$tem1[0]."兑换".$tem1[1].".<INPUT type=\"hidden\" value=\"".$row[id]."\" name=\"dhid\"><INPUT type=\"hidden\" value=\"duihuan_hu\" name=\"go\"><input type=\"submit\" class=\"btn80_1\" name=\"Submit\" id=\"submit\" value=\"兑换\"><font color=\"#FF0000\">(您拥有".$moneyinfo[$tem3[0]].$tem1[0].")</font></form></div>";

}
echo $str."</div>";
}
?>


</div>

<script type="text/javascript">

    var clipboardswfdata;

    var setcopy_gettext = function () {

        clipboardswfdata = document.getElementById('tgTxt').value;

        window.document.clipboardswf.SetVariable('str', clipboardswfdata);

    };

    var floatwin = function () {

        alert("复制成功，你可以使用Ctrl+V 贴到需要的地方去了哦！  ");

    };

</script>

</div></div>
<?php
	require "footer.php";
?>

</body>