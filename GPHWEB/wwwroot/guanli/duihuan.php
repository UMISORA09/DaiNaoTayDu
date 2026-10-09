<?php
include 'getfunction.php';
ckdenglu();
$duihuaninfo=mysql_query("SELECT * FROM duihuan order by id asc");
$num=mysql_num_rows($duihuaninfo);
for($i=0;$i<$num;$i++)
{
   $duihuanrow=mysql_fetch_array($duihuaninfo);

   $duihuanvar[$i][bili]=$duihuanrow[bili];
   $duihuanvar[$i][kaifang]=$duihuanrow[kaifang];
}
function checkedecho($sss)
{
if($sss==1)
return "checked";
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<TABLE border="1" cellspacing="1" width="100%" cellpadding="3" style="border-collapse: collapse;border:0px solid  #A5CF7A" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" bgcolor="#F5F5F5">
   <tr>
    <td height="32" colspan="2" align="center" valign="middle"  class="tit_bg"><b>兑换比例设置</b></td>
   </tr>
  <form action="Action.php" method="post" name="Form1" onSubmit="return check()">
  <tr>
    <td width="15%" height="30" align="right" valign="middle">现金换积分：</td>
    <td width="85%" valign="middle" class="huise_font">
	<input name="moneytojifen" type="text" id="gamename" size="20"  class="inputclass inputtitle" value="<?=$duihuanvar[0][bili];?>" /><input type="checkbox" name="moneytojifenroleChk" <?=checkedecho($duihuanvar[0][kaifang]);?> value="1">开启</td>
  </tr>
 
  <tr>
    <td height="30" align="right" valign="middle">现金换元宝(站内元宝)：</td>
    <td valign="middle" class="huise_font"><input name="moneytogold" id="webname" type="text" size="20" class="inputclass inputtitle" value="<?=$duihuanvar[1][bili];?>" /><input type="checkbox" <?=checkedecho($duihuanvar[1][kaifang]);?> name="moneytogoldroleChk" value="1">开启</td>
  </tr>  
  
  <tr>
    <td height="30" align="right" valign="middle">积分换现金：</td>
    <td valign="middle" class="huise_font"><input name="jifentomoney" id="website" type="text" size="20" class="inputclass inputtitle" value="<?=$duihuanvar[2][bili];?>" /><input type="checkbox" <?=checkedecho($duihuanvar[2][kaifang]);?> name="jifentomoneyroleChk" value="1">开启</td>
  </tr>
  
  <tr>
    <td height="30" align="right" valign="middle">积分换元宝：</td>
    <td valign="middle" class="huise_font"><input name="jifentogold" id="website" type="text" size="20" class="inputclass inputtitle" value="<?=$duihuanvar[3][bili];?>" /><input type="checkbox" <?=checkedecho($duihuanvar[3][kaifang]);?> name="jifentogoldroleChk" value="1">开启</td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">元宝换现金：</td>
    <td valign="middle" class="huise_font"><input name="goldtomoney" id="website" type="text" size="20" class="inputclass inputtitle" value="<?=$duihuanvar[4][bili];?>" /><input type="checkbox" <?=checkedecho($duihuanvar[4][kaifang]);?> name="goldtomoneyroleChk" value="1">开启</td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">元宝换积分：</td>
    <td valign="middle" class="huise_font"><input name="goldtojifen" id="website" type="text" size="20" class="inputclass inputtitle" value="<?=$duihuanvar[5][bili];?>" /><input type="checkbox" <?=checkedecho($duihuanvar[5][kaifang]);?> name="goldtojifenroleChk" value="1">开启</td>
  </tr>
   <tr>
    <td height="30" align="right" valign="middle">推广数换现金：</td>
    <td valign="middle" class="huise_font"><input name="tgtomoney" id="website" type="text" size="20" class="inputclass inputtitle" value="<?=$duihuanvar[6][bili];?>" /><input type="checkbox" <?=checkedecho($duihuanvar[6][kaifang]);?> name="tgtomoneyroleChk" value="1">开启</td>
  </tr>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">推广数换积分：</td>
    <td valign="middle" class="huise_font"><input name="tgtojifen" id="website" type="text" size="20" class="inputclass inputtitle" value="<?=$duihuanvar[7][bili];?>" /><input type="checkbox" <?=checkedecho($duihuanvar[7][kaifang]);?> name="tgtojifenroleChk" value="1">开启</td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">推广数换元宝：</td>
    <td valign="middle" class="huise_font"><input name="tgtogold" id="website" type="text" size="20" class="inputclass inputtitle" value="<?=$duihuanvar[8][bili];?>" /><input type="checkbox" <?=checkedecho($duihuanvar[8][kaifang]);?> name="tgtogoldroleChk" value="1">开启</td>
  </tr>
  
  <tr>
    <td height="30" align="right" valign="middle">现金充值元宝(游戏内)：</td>
    <td valign="middle" class="huise_font"><input name="moneytoggold" id="website" type="text" size="20" class="inputclass inputtitle" value="<?=$duihuanvar[9][bili];?>" /><input type="checkbox" <?=checkedecho($duihuanvar[9][kaifang]);?> name="moneytoggoldroleChk" value="1">开启</td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">积分充值元宝(游戏内)：</td>
    <td valign="middle" class="huise_font"><input name="jifentoggold" id="website" type="text" size="20" class="inputclass inputtitle" value="<?=$duihuanvar[10][bili];?>" /><input type="checkbox" <?=checkedecho($duihuanvar[10][kaifang]);?> name="jifentoggoldroleChk" value="1">开启</td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">元宝充值元宝(游戏内)：</td>
    <td valign="middle" class="huise_font"><input name="goldtoggold" id="website" type="text" size="20" class="inputclass inputtitle" value="<?=$duihuanvar[11][bili];?>" /><input type="checkbox" <?=checkedecho($duihuanvar[11][kaifang]);?> name="goldtoggoldroleChk" value="1">开启</td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">推广数充值元宝(游戏内)：</td>
    <td valign="middle" class="huise_font"><input name="tgtoggold" id="website" type="text" size="20" class="inputclass inputtitle" value="<?=$duihuanvar[12][bili];?>" /><input type="checkbox" <?=checkedecho($duihuanvar[12][kaifang]);?> name="tgtoggoldroleChk" value="1">开启</td>
  </tr>
  <tr>
    <td height="50" colspan="2" align="center" valign="middle">
	    <INPUT type="hidden" value="duihuan" name="go"> 
        <input type="submit" class="btn80_1" name="Submit" id="submit" value="确认修改">
    </td>
  </tr>
  
  </form>
</table>
<div style="display: none">
</div>
</body>
</html>