<?php
include 'getfunction.php';
ckdenglu();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<TABLE border="1" cellspacing="1" width="100%" cellpadding="3" style="border-collapse: collapse;border:0px solid  #A5CF7A" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" bgcolor="#F5F5F5">
   <tr>
    <td height="32" colspan="2" align="center" valign="middle"  class="tit_bg"><b>合区</b></td>
   </tr>
  <form action="Action.php" method="post" name="Form1" onSubmit="return check()">
  <tr>
    <td width="50%" height="30" align="center" valign="middle">老区：</td>
    <td width="50%" align="center" valign="middle" class="huise_font">新区:</td>
  </tr>
  <tr>
    <td height="30"  valign="middle" align="left" >选择老区：        <select name='shop_showline' id="category">
            <option value='1' selected='selected' >第一行</option>
            <option value='2' >第二行</option>
            <option value='3' >第三行</option>
        </select></td>
    <td height="30"  valign="middle" align="left" >选择新区：        <select name='shop_showline' id="category">
            <option value='1' selected='selected' >第一行</option>
            <option value='2' >第二行</option>
            <option value='3' >第三行</option>
        </select></td>
  </tr>
  <tr>
  <tr>
    <td height="30" align="left" valign="middle">显示位置：</td>
    <td valign="middle" align="left" class="huise_font"><input name="shop_show" id="website" type="text" size="50" class="inputclass inputtitle" value="1" />数字越小越靠前</td>
  </tr>
    <td height="50" colspan="2" align="center" valign="middle">
	    <INPUT type="hidden" value="shop_tag" name="go"> 
        <input type="submit" class="btn80_1" name="Submit" id="submit" value="确认提交">
    </td>
  </tr>
  
  </form>
</table>



<div style="display: none">
</div>
</body>
</html>