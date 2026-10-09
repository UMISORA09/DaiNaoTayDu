<?php
include 'getfunction.php';
ckdenglu();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<TABLE border="1" cellspacing="1" width="100%" cellpadding="2" style="margin-top:2px;border-collapse: collapse;border:1px solid Silver" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" >
   <tr onmouseover="this.className='mouseon'" onmouseout="this.className='';">    
    <td height="25" align="center" valign="middle"  colspan="10">消费查询</td>
  <tr bgcolor="#F1F1F1" style="color:#CC3300;" class="tabletr">
    <td width="8%" align="center" valign="middle">商城</td>
    <td height="22" width="4%" align="center" valign="middle">角色充值</td>
    <td width="8%" align="center" valign="middle">站内兑换</td>
    <td width="6%" align="center" valign="middle">礼包</td>
    <td width="6%" align="center" valign="middle">账号查询</td>
	<td width="6%" align="center" valign="middle">角色名查询</td>
	<td width="6%" align="center" valign="middle">所有</td>
  </tr>
  <tr onmouseover="this.className='mouseon'" onmouseout="this.className='';" class="tabletr">
   <td align="center" valign="middle"><a href="?go=cx&lx=ty&z=sc" style="color:#1b10f5;" target="_self">查询</a></td>
    <td height="25" align="center" valign="middle"><a href="?go=cx&lx=ty&z=jscz" style="color:#1b10f5;" target="_self">查询</a></td>
    <td align="center" valign="middle"><a href="?go=cx&lx=ty&z=zndh" style="color:#1b10f5;" target="_self">查询</a></td>
    <td align="center" valign="middle"><a href="?go=cx&lx=ty&z=lb" style="color:#1b10f5;" target="_self">查询</a></td>
    <td align="center" valign="middle">
	<form action="#" method="get" name="Form1" onSubmit="return check()">
	<input name="name" id="website" type="text" size="5" class="inputclass inputtitle" value="" />
	<INPUT type="hidden" value="zhcx" name="lx"> 
	<INPUT type="hidden" value="cx" name="go"> 
        <input type="submit" class="btn80_1" name="Submit" id="submit" value="查询">
		</form></td>
	<td align="center" valign="middle">
	<form action="#" method="get" name="Form1" onSubmit="return check()">
	<input name="name" id="website" type="text" size="5" class="inputclass inputtitle" value="" />
	<INPUT type="hidden" value="jsmcx" name="lx"> 
	<INPUT type="hidden" value="cx" name="go"> 
        <input type="submit" class="btn80_1" name="Submit" id="submit" value="查询">
		</form></td>
	<td height="25" align="center" valign="middle"><a href="?go=cx&lx=sy" style="color:#1b10f5;" target="_self">查询</a></td>
  </tr>
</table>
<br/>
<br/>
<br/>



<?php 
if($_GET['go']=="cx")
{
if($_GET['lx']=="ty")
{
  if($_GET['z']=="sc")
  {
  $lx="商城";
  }else if($_GET['z']=="jscz")
  {
  $lx="角色充值";
  }else if($_GET['z']=="zndh")
  {
  $lx="站内兑换";
  }else if($_GET['z']=="lb")
  {
  $lx="礼包";
  }
  $xfinfo=mysql_query("SELECT * FROM xiaofei where lx ='".$lx."'");
}else if($_GET['lx']=="zhcx")
{
 $xfinfo=mysql_query("SELECT * FROM xiaofei where name ='".$_GET['name']."'");
}else if($_GET['lx']=="jsmcx")
{
 $xfinfo=mysql_query("SELECT * FROM xiaofei where rolename ='".$_GET['name']."'");
}else if($_GET['lx']=="sy")
{
$xfinfo=mysql_query("SELECT * FROM xiaofei order by id desc");
}

$num=mysql_num_rows($xfinfo);
?>
<TABLE border="1" cellspacing="1" width="100%" cellpadding="2" style="margin-top:2px;border-collapse: collapse;border:1px solid Silver" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" >

   <tr onmouseover="this.className='mouseon'" onmouseout="this.className='';">    
    <td height="25" align="center" valign="middle"  colspan="10">消费查询</td>
  <tr bgcolor="#F1F1F1" style="color:#CC3300;" class="tabletr">
    <td width="8%" align="center" valign="middle">ID</td>
    <td height="22" width="4%" align="center" valign="middle">账号名称</td>
    <td width="6%" align="center" valign="middle">角色ID</td>
    <td width="6%" align="center" valign="middle">角色名</td>
	<td width="6%" align="center" valign="middle">条件1</td>
	<td width="6%" align="center" valign="middle">条件2</td>
    <td width="6%" align="center" valign="middle">获得1</td>
    <td width="6%" align="center" valign="middle">获得2</td>
    <td width="8%" align="center" valign="middle">时间</td>
    <td width="7%" align="center" valign="middle">途径</td>
  </tr>
<?php
for($i=0;$i<$num;$i++)
{
$xfrow=mysql_fetch_array($xfinfo);
?>
 <tr onmouseover="this.className='mouseon'" onmouseout="this.className='';" class="tabletr">
   <td align="center" valign="middle"><?=$xfrow[id];?></td>
    <td height="25" align="center" valign="middle"><?=$xfrow[name];?></td>
    <td align="center" valign="middle"><?=$xfrow[roleid];?></td>
    <td align="center" valign="middle"><?=$xfrow[rolename];?></td>
    <td align="center" valign="middle"><?=$xfrow[H_lxnum];?></td>
	<td align="center" valign="middle"><?=$xfrow[H_lx];?></td>
	<td align="center" valign="middle"><?=$xfrow[D_lxnum];?></td>
	<td align="center" valign="middle"><?=$xfrow[D_lx];?></td>
    <td align="center" valign="middle"><?=$xfrow[time];?></td>
	<td align="center" valign="middle"><?=$xfrow[lx];?></td>
  </tr>
<?php
}
}
?>

