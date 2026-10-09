<?php
include 'getfunction.php';
ckdenglu();
$tem=file_get_contents("../sysconfig.php");

$webname=explode("webname=\"",$tem);
$webname=explode("\";",$webname[1]);
$webname=$webname[0];

$webdomain=explode("webdomain=\"",$tem);
$webdomain=explode("\";",$webdomain[1]);
$webdomain=$webdomain[0];

$chongzhiweb=explode("chongzhiweb=\"",$tem);
$chongzhiweb=explode("\";",$chongzhiweb[1]);
$chongzhiweb=$chongzhiweb[0];
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<TABLE border="1" cellspacing="1" width="100%" cellpadding="3" style="border-collapse: collapse;border:0px solid  #A5CF7A" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" bgcolor="#F5F5F5">
   <tr>
    <td height="32" colspan="2" align="center" valign="middle"  class="tit_bg"><b>基本设置</b></td>
   </tr>
  <form action="Action.php" method="post" name="Form1" onSubmit="return check()">
  <tr>
    <td width="12%" height="30" align="right" valign="middle">网站名称：</td>
    <td width="88%" valign="middle" class="huise_font">
	<input name="webname" type="text" id="gamename" size="50"  class="inputclass inputtitle" value="<?=$webname;?>" /></td>
  </tr>
 
  <tr>
    <td height="30" align="right" valign="middle">网站地址：</td>
    <td valign="middle" class="huise_font"><input name="webdomain" id="webname" type="text" size="50" class="inputclass inputtitle" value="<?=$webdomain;?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">充值链接：</td>
    <td valign="middle" class="huise_font"><input name="chongzhiweb" id="chongzhiweb" type="text" size="50" class="inputclass inputtitle" value="<?=$chognzhiweb;?>" /></td>
  </tr>  
  
  <tr>
    <td height="50" colspan="2" align="center" valign="middle">
	<INPUT type="hidden" value="sys" name="go"> 
        <input type="submit" class="btn80_1" name="Submit" id="submit" value="确认修改">    </td>
  </tr>
  </form>
</table>
<div style="display: none">
</div>
</body>
</html>