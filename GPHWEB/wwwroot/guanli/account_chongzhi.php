<?php
include 'getfunction.php';
ckdenglu();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<TABLE border="1" cellspacing="1" width="100%" cellpadding="3" style="border-collapse: collapse;border:0px solid  #A5CF7A" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" bgcolor="#F5F5F5">
   <tr>
    <td height="32" colspan="2" align="center" valign="middle"  class="tit_bg"><b>账号充值</b></td>
   </tr>
  <form action="Action.php" method="post" name="Form1" onSubmit="return check()">
  <tr>
    <td height="30" align="right" valign="middle">账号：</td>
    <td valign="middle" class="huise_font"><input name="account" id="webname" type="text" size="50" class="inputclass inputtitle" value="0" /></td>
  </tr> 
  <tr>
    <td height="30" align="right" valign="middle">现金：</td>
    <td valign="middle" class="huise_font"><input name="money" id="webname" type="text" size="10" class="inputclass inputtitle" value="0" /></td>
  </tr>  
  <tr>
    <td height="30" align="right" valign="middle">积分：</td>
    <td valign="middle" class="huise_font"><input name="jifen" id="website" type="text" size="10" class="inputclass inputtitle" value="0" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">元宝：</td>
    <td valign="middle" class="huise_font"><input name="gold" id="website" type="text" size="10" class="inputclass inputtitle" value="0" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">推广：</td>
    <td valign="middle" class="huise_font"><input name="tg" id="webname" type="text" size="10" class="inputclass inputtitle" value="0" /></td>
  </tr> 
  <tr>
    <td height="50" colspan="2" align="center" valign="middle">
		    <INPUT type="hidden" value="account_chongzhi" name="go"> 
        <input type="submit" class="btn80_1" name="Submit" id="submit" value="确认提交">
    </td>
  </tr>
  
  </form>
</table>