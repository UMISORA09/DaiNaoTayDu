<?php
include 'getfunction.php';
ckdenglu();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<TABLE border="1" cellspacing="1" width="100%" cellpadding="2" style="margin-top:2px;border-collapse: collapse;border:1px solid Silver" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" >

   <tr onmouseover="this.className='mouseon'" onmouseout="this.className='';">    
    <td height="25" align="center" valign="middle"  colspan="10">礼包管理</td>
  <tr bgcolor="#F1F1F1" style="color:#CC3300;" class="tabletr">
    <td height="22" width="4%" align="center" valign="middle">礼包名称</td>
    <td width="8%" align="center" valign="middle">领取等级</td>
    <td width="6%" align="center" valign="middle">物品代码</td>
    <td width="6%" align="center" valign="middle">铜钱</td>
	<td width="6%" align="center" valign="middle">元宝</td>
	<td width="7%" align="center" valign="middle">介绍说明</td>
	<td width="7%" align="center" valign="middle">显示位置</td>
    <td width="5%" align="center" valign="middle">操作</td>
  </tr>
  
<?php 
 include "../config.php";
 $serverinfo=mysql_query("SELECT * FROM libao_list");
 $num=mysql_num_rows($serverinfo);
 if( $num==0)
 {
 ?>
   <tr onmouseover="this.className='mouseon'" onmouseout="this.className='';">    
    <td height="25" align="center" valign="middle" colspan="10">暂无记录！</td>
  </tr>
  <?php
 }else
 {
  for($i=0;$i<$num;$i++)
  {
  $row=mysql_fetch_array($serverinfo);
 ?>
  <tr onmouseover="this.className='mouseon'" onmouseout="this.className='';" class="tabletr">    
    <td height="25" align="center" valign="middle"><?=$row[libao_name];?></td>
    <td align="center" valign="middle"><?=$row[libao_level];?></td>
    <td align="center" valign="middle"><?=stripslashes($row[libao_code]);?></td>
    <td align="center" valign="middle"><?=$row[libao_coin];?></td>
	<td align="center" valign="middle"><?=$row[libao_gold];?></td>
	<td align="center" valign="middle"><?=$row[libao_content];?></td>
	<td align="center" valign="middle"><?=$row[libao_show];?></td>
    <td align="center"><a href="?go=edit&s=<?=$row[id];?>" style="color:#1b10f5;" target="_self">编辑</a>|<a href="Action.php?go=del_libao&s=<?=$row[id];?>" style="color:#1b10f5;" target="_self">删除</a></td>
  </tr>
  <?php
 }
 }
 ?>
</table>
<br/>
<br/>
<br/>

<?php 
if ($_GET[go]=="edit")
{
  $id=addslashes(trim($_GET['s']));
  if($id!="")
  {
    $serverinfo=mysql_fetch_array(mysql_query("SELECT * FROM libao_list where id =".$id));
?>
<TABLE border="1" cellspacing="1" width="100%" cellpadding="3" style="border-collapse: collapse;border:0px solid  #A5CF7A" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" bgcolor="#F5F5F5">
   <tr>
    <td height="32" colspan="2" align="center" valign="middle"  class="tit_bg"><b>编辑礼包</b></td>
   </tr>
  <form action="Action.php" method="post" name="Form1" onSubmit="return check()">
   
  <INPUT type="hidden" value="<?=$serverinfo[id];?>" name="sid">
  <tr>
    <td width="12%" height="30" align="right" valign="middle">礼包ID：</td>
    <td width="88%" valign="middle" class="huise_font">
	<input name="" disabled="true" type="text" id="gamename" size="5"  class="inputclass inputtitle" value="<?=$serverinfo[id];?>" /></td>
  </tr>
  
  
  <tr>
    <td width="12%" height="30" align="right" valign="middle">礼包名称：</td>
    <td width="88%" valign="middle" class="huise_font">
	<input name="libao_name" type="text" id="gamename" size="50"  class="inputclass inputtitle" value="<?=$serverinfo[libao_name];?>" /></td>
  </tr>
 
  <tr>
    <td height="30" align="right" valign="middle">领取等级：</td>
    <td valign="middle" class="huise_font"><input name="libao_level" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[libao_level];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">物品：</td>
    <td valign="middle" class="huise_font"><input name="libao_code" id="website" type="text" size="200" class="inputclass inputtitle" value='<?=stripslashes($serverinfo[libao_code]);?>' /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">铜钱：</td>
    <td valign="middle" class="huise_font"><input name="libao_coin" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[libao_coin];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">元宝：</td>
    <td valign="middle" class="huise_font"><input name="libao_gold" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[libao_gold];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">介绍说明：</td>
    <td valign="middle" class="huise_font"><input name="libao_content" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[libao_content];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">显示位置：</td>
    <td valign="middle" class="huise_font"><input name="libao_show" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[libao_show];?>" />数字越小越靠前</td>
  </tr>
  <tr>
    <td height="50" colspan="2" align="center" valign="middle">
		    <INPUT type="hidden" value="libao_edit" name="go"> 
        <input type="submit" class="btn80_1" name="Submit" id="submit" value="确认修改">
    </td>
  </tr>
  
  </form>
</table>

<?php
}
}else
{
?>



<TABLE border="1" cellspacing="1" width="100%" cellpadding="3" style="border-collapse: collapse;border:0px solid  #A5CF7A" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" bgcolor="#F5F5F5">
   <tr>
    <td height="32" colspan="2" align="center" valign="middle"  class="tit_bg"><b>添加礼包</b></td>
   </tr>
  <form action="Action.php" method="post" name="Form1" onSubmit="return check()">
  <tr>
    <td width="12%" height="30" align="right" valign="middle">礼包名称：</td>
    <td width="88%" valign="middle" class="huise_font">
	<input name="libao_name" type="text" id="gamename" size="50"  class="inputclass inputtitle" value="" /></td>
  </tr>
 
  <tr>
    <td height="30" align="right" valign="middle">领取等级：</td>
    <td valign="middle" class="huise_font"><input name="libao_level" id="website" type="text" size="50" class="inputclass inputtitle" value="1" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">物品：</td>
    <td valign="middle" class="huise_font"><input name="libao_code" id="website" type="text" size="200" class="inputclass inputtitle" value="0" />{物品ID,物品数量,物品品质,物品强化,物品绑定};{物品ID,物品数量,物品品质,物品强化,物品绑定}可多个物品用分号隔开,请注意符号为半角</td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">铜钱：</td>
    <td valign="middle" class="huise_font"><input name="libao_coin" id="website" type="text" size="50" class="inputclass inputtitle" value="" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">元宝：</td>
    <td valign="middle" class="huise_font"><input name="libao_gold" id="website" type="text" size="50" class="inputclass inputtitle" value="" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">介绍说明：</td>
    <td valign="middle" class="huise_font"><input name="libao_content" id="website" type="text" size="50" class="inputclass inputtitle" value="" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">显示位置：</td>
    <td valign="middle" class="huise_font"><input name="libao_show" id="website" type="text" size="50" class="inputclass inputtitle" value="0" />数字越小越靠前</td>
  </tr>

  <tr>
    <td height="50" colspan="2" align="center" valign="middle">
		    <INPUT type="hidden" value="libao_add" name="go"> 
        <input type="submit" class="btn80_1" name="Submit" id="submit" value="确认提交">
    </td>
  </tr>
  
  </form>
</table>

<?php 
}
?>
<div style="display: none">
</div>
</body>
</html>