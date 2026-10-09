<?php
include '../config.php';



function ckcookie()
{
   $GLOBALS["gcook"]=0;
   if (isset($_COOKIE["admin"]))
   {   
       $m=explode(":",$_COOKIE["admin"]);
       $userinfo = mysql_fetch_array(mysql_query("SELECT * FROM admin_user WHERE admin_name='".addslashes($m[0])."'"));
       if ($userinfo)
       {
	      $pass=strtolower($userinfo[admin_pass]);
	      if(md5($m[0].$pass)==$m[1])
		  {
		  $GLOBALS["gname"]=$userinfo[admin_name];
		  $GLOBALS["gcook"]=1;	  
		  }

		}
	}

}
function ckdenglu()
{
  if(isset($GLOBALS["gcook"])==false)
  {
  ckcookie();
  }
  if($GLOBALS["gcook"]==0)
  {
     echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
     echo "<script>location.href='login.php'</script>";
     exit;
  }
}




function ConnectMysql($mysqlip,$mysqlname,$mysqlpass,$mysqlroledb,$servername)
{
  $conn=mysql_connect($mysqlip,$mysqlname,$mysqlpass);
    if($conn==false)
    {
		//include 'config.php';
       // return "连接数据库失败！请检查”".$serverrow[servername]."“的数据库配置信息!";
       // exit;
	  
	   $str=$str."连接数据库失败！请检查”".$servername."“的数据库配置信息!";
	    continue;
	   
    }
    if(mysql_select_db($mysqlroledb,$conn)==false)
    {
        //include 'config.php';
        //return "选择角色数据库失败!请检查”".$serverrow[servername]."“的数据库配置信息!";
        //exit;
		$str=$str."选择角色数据库失败!请检查”".$servername."“的数据库配置信息!";
		continue;
	}
    mysql_query("SET @@character_set_connection=utf8,@@character_set_results=utf8,@@character_set_client=utf8");
	return $conn;
}