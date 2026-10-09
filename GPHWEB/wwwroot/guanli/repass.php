<?php
include 'getfunction.php';
ckdenglu();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<TABLE border="1" cellspacing="1" width="100%" cellpadding="3" style="border-collapse: collapse;border:0px solid  #A5CF7A" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" bgcolor="#F5F5F5">
   <tr>
    <td height="32" colspan="2" align="center" valign="middle"  class="tit_bg"><b>修改密码</b></td>
   </tr>
  <form action="Action.php" method="post" name="Form1" onSubmit="return check()">
  <tr>
    <td width="12%" height="30" align="right" valign="middle">用户名：</td>
    <td width="88%" valign="middle" class="huise_font">
	<?=$GLOBALS["gname"];?> </td>
  </tr>
   <tr>
    <td width="12%" height="30" align="right" valign="middle">老密码：</td>
    <td width="88%" valign="middle" class="huise_font">
	<input name="password" type="text" id="gamename" size="50"  class="inputclass inputtitle" value="" /></td>
  </tr>
    <tr>
    <td width="12%" height="30" align="right" valign="middle">新密码：</td>
    <td width="88%" valign="middle" class="huise_font">
	<input name="newpassword" type="text" id="gamename" size="50"  class="inputclass inputtitle" value="" /></td>
  </tr>
    <tr>
    <td width="12%" height="30" align="right" valign="middle">重复新密码：</td>
    <td width="88%" valign="middle" class="huise_font">
	<input name="newpassword2" type="text" id="gamename" size="50"  class="inputclass inputtitle" value="" /></td>
  </tr>
  <tr>
    <td height="50" colspan="2" align="center" valign="middle">
	    <INPUT type="hidden" value="repass" name="go"> 
        <input type="submit" class="btn80_1" name="Submit" id="submit" value="确认提交">
    </td>
  </tr>
  
  </form>
</table>