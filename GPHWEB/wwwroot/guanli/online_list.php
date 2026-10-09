<?php
include 'getfunction.php';
ckdenglu();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
 include "../config.php";
 $serverinfo=mysql_query("SELECT * FROM server");
 $num=mysql_num_rows($serverinfo);
 if( $num==0)
 {
 ?>
   <tr onmouseover="this.className='mouseon'" onmouseout="this.className='';">    
    <td height="25" align="center" valign="middle" colspan="10">还没添加区呢！</td>
  </tr>
  <?php
 }else
 {
     for($i=0;$i<$num;$i++)
     {
	 $serverrow=mysql_fetch_array($serverinfo);
     $conn=mysql_connect($serverrow[mysqlip],$serverrow[mysqlname],$serverrow[mysqlpass]);
  if($conn==false)
  {
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        echo "<script>alert('连接数据库失败！请检查”".$serverrow[servername]."“的数据库配置信息!');location.href='role_addarticle.php'</script>";
        exit;
  }
  if(mysql_select_db($serverrow[mysqlroledb],$conn)==false)
  {
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
        echo "<script>alert('选择角色数据库失败!请检查”".$serverrow[servername]."“的数据库配置信息!');location.href='role_addarticle.php'</script>";
        exit;
  }
  mysql_query("SET @@character_set_connection=utf8,@@character_set_results=utf8,@@character_set_client=utf8");
  $onlineinfo=mysql_query("select * from user_role where offline_time<online_time");
  $num1=mysql_num_rows($onlineinfo);
?>
<TABLE border="1" cellspacing="1" width="100%" cellpadding="2" style="margin-top:2px;border-collapse: collapse;border:1px solid Silver" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" >

   <tr onmouseover="this.className='mouseon'" onmouseout="this.className='';">    
    <td height="25" align="center" valign="middle" colspan="10"><?=$serverrow[servername];?>在线角色(<?=$num1;?>):</td>
  <tr bgcolor="#F1F1F1" style="color:#CC3300;" class="tabletr">
    <td height="22" width="4%" align="center" valign="middle">角色ID</td>
    <td width="8%" align="center" valign="middle">角色名称</td>
    <td width="6%" align="center" valign="middle">等级</td>
    <td width="6%" align="center" valign="middle">职业</td>
	<td width="6%" align="center" valign="middle">性别</td>
    <td width="6%" align="center" valign="middle">创建时间</td>
    <td width="6%" align="center" valign="middle">登陆时间</td>
    <td width="6%" align="center" valign="middle">登陆次数</td>
  </tr>
<?php
  if( $num1==0)
 {
 ?>
   <tr onmouseover="this.className='mouseon'" onmouseout="this.className='';">    
    <td height="25" align="center" valign="middle" colspan="10">没有角色在线！</td>
  </tr>
  <?php
 }else
 { 
  for($ii=0;$ii<$num1;$ii++)
  {
  $onlinerow=mysql_fetch_array($onlineinfo);

   			if($onlinerow[job]=="A")
			{
			 $zhiye="灵猴";
			}else if($onlinerow[job]=="B")
			{
			 $zhiye="九尾";
			}else if($onlinerow[job]=="C")
			{
			 $zhiye="牛魔";
			}else if($onlinerow[job]=="D")
			{
			 $zhiye="罗刹";
			}
			 if($onlinerow[sex]=="0")
			{
			 $sex="男";
			}else if($onlinerow[sex]=="1")
			{
			 $sex="女";
			}
			
			$dl_time=substr($onlinerow[online_time],0,10);
			$dl_time=date("Y-m-d H:i:s",$dl_time);
  ?>
   <tr onmouseover="this.className='mouseon'" onmouseout="this.className='';" class="tabletr">    
    <td height="25" align="center" valign="middle"><?=$onlinerow[id];?></td>
    <td align="center" valign="middle"><?=$onlinerow[name];?></td>
    <td align="center" valign="middle"><?=$onlinerow[level];?></td>
    <td align="center" valign="middle"><?=$zhiye;?></td>
    <td align="center" valign="middle"><?=$sex;?></td>
    <td align="center" valign="middle"><?=$onlinerow[create_time]; ?></td>
    <td align="center" valign="middle"><?=$dl_time;?></td>
	 <td align="center" valign="middle"><?=$onlinerow[login_count];?></td>
  </tr>
    <?php
 }
 }
 }
  echo "</table><br/><br/><br/>";
 }
 ?>