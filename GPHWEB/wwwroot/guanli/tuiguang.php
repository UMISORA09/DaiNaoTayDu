<?php
include 'getfunction.php';
ckdenglu();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<TABLE border="1" cellspacing="1" width="100%" cellpadding="2" style="margin-top:2px;border-collapse: collapse;border:1px solid Silver" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" >
   <tr onmouseover="this.className='mouseon'" onmouseout="this.className='';">    
    <td height="25" align="center" valign="middle"  colspan="10">推广查询</td>
  <tr bgcolor="#F1F1F1" style="color:#CC3300;" class="tabletr">
    <td width="8%" align="center" valign="middle">IP查询</td>
    <td height="22" width="4%" align="center" valign="middle">时间查询</td>
    <td width="8%" align="center" valign="middle">推广人名查询</td>
	<td width="6%" align="center" valign="middle">所有</td>
  </tr>
  <tr onmouseover="this.className='mouseon'" onmouseout="this.className='';" class="tabletr">
   <td align="center" valign="middle"><form action="#" method="get" name="Form1" onSubmit="return check()">
	<input name="name" id="website" type="text" size="5" class="inputclass inputtitle" value="" />
	<INPUT type="hidden" value="ipcx" name="lx"> 
	<INPUT type="hidden" value="cx" name="go"> 
        <input type="submit" class="btn80_1" name="Submit" id="submit" value="查询">
		</form></td>
    <td height="25" align="center" valign="middle"><form action="#" method="get" name="Form1" onSubmit="return check()">
	<input name="name" id="website" type="text" size="5" class="inputclass inputtitle" value="" />
	<INPUT type="hidden" value="sjcx" name="lx"> 
	<INPUT type="hidden" value="cx" name="go"> 
        <input type="submit" class="btn80_1" name="Submit" id="submit" value="查询">
		</form></td>
    <td align="center" valign="middle"><form action="#" method="get" name="Form1" onSubmit="return check()">
	<input name="name" id="website" type="text" size="5" class="inputclass inputtitle" value="" />
	<INPUT type="hidden" value="tgrcx" name="lx"> 
	<INPUT type="hidden" value="cx" name="go"> 
        <input type="submit" class="btn80_1" name="Submit" id="submit" value="查询">
		</form></td>
    <td align="center" valign="middle"><a href="?go=cx&lx=sy" style="color:#1b10f5;" target="_self">查询</a></td>
	</tr>
</table>
<br/>
<br/>
<br/>



<?php 
if($_GET['go']=="cx")
{
if($_GET['lx']=="ipcx")
{
  $xfinfo=mysql_query("SELECT * FROM tuiguang where ip ='".$_GET['name']."'");
}else if($_GET['lx']=="sjcx")
{
 $xfinfo=mysql_query("SELECT * FROM tuiguang where time ='".$_GET['name']."'");
}else if($_GET['lx']=="tgrcx")
{
 $xfinfo=mysql_query("SELECT * FROM tuiguang where tgr ='".$_GET['name']."'");
}else if($_GET['lx']=="sy")
{
$xfinfo=mysql_query("SELECT * FROM tuiguang order by id desc");
}

$num=mysql_num_rows($xfinfo);
?>
<TABLE border="1" cellspacing="1" width="100%" cellpadding="2" style="margin-top:2px;border-collapse: collapse;border:1px solid Silver" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" >

   <tr onmouseover="this.className='mouseon'" onmouseout="this.className='';">    
    <td height="25" align="center" valign="middle"  colspan="10">推广查询</td>
  <tr bgcolor="#F1F1F1" style="color:#CC3300;" class="tabletr">
    <td width="8%" align="center" valign="middle">ID</td>
    <td height="22" width="4%" align="center" valign="middle">推广人</td>
    <td width="6%" align="center" valign="middle">被推广人</td>
    <td width="6%" align="center" valign="middle">IP</td>
	<td width="6%" align="center" valign="middle">时间</td>
	<td width="6%" align="center" valign="middle">有效值</td>
  </tr>
<?php
for($i=0;$i<$num;$i++)
{
$xfrow=mysql_fetch_array($xfinfo);
?>
 <tr onmouseover="this.className='mouseon'" onmouseout="this.className='';" class="tabletr">
   <td align="center" valign="middle"><?=$xfrow[id];?></td>
    <td height="25" align="center" valign="middle"><?=$xfrow[tgr];?></td>
    <td align="center" valign="middle"><?=$xfrow[btg];?></td>
    <td align="center" valign="middle"><?=$xfrow[ip];?></td>
    <td align="center" valign="middle"><?=$xfrow[time];?></td>
	<td align="center" valign="middle"><?=$xfrow[num];?></td>
  </tr>
<?php
}
}
?>
</table>
<br/>
<br/>
<br/>
