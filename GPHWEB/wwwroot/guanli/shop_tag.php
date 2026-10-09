<?php
include 'getfunction.php';
ckdenglu();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<TABLE border="1" cellspacing="1" width="100%" cellpadding="2" style="margin-top:2px;border-collapse: collapse;border:1px solid Silver" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" >

   <tr onmouseover="this.className='mouseon'" onmouseout="this.className='';">    
    <td height="25" align="center" valign="middle" colspan="10">商品分类管理</td>
  <tr bgcolor="#F1F1F1" style="color:#CC3300;" class="tabletr">
  <td width="8%" align="center" valign="middle">商品ID</td>
  <td width="8%" align="center" valign="middle">商品分类</td>
    <td width="8%" align="center" valign="middle">商品显示位置</td>
	<td width="7%" align="center" valign="middle">显示位置</td>
    <td width="5%" align="center" valign="middle">操作</td>
  </tr>
  
<?php 
 include "../config.php";
 $serverinfo=mysql_query("SELECT * FROM shop_tag");
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
    <td height="25" align="center" valign="middle"><?=$row[id];?></td>
    <td align="center" valign="middle"><?=$row[shop_tag];?></td>
	<td align="center" valign="middle"><?=$row[shop_showline];?></td>
	<td align="center" valign="middle"><?=$row[shop_show];?></td>
    <td align="center"><a href="?go=edit&s=<?=$row[id];?>" style="color:#1b10f5;" target="_self">编辑</a>|<a href="Action.php?go=del_shoptag&s=<?=$row[id];?>" style="color:#1b10f5;" target="_self">删除</a></td>
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
    $serverinfo=mysql_fetch_array(mysql_query("SELECT * FROM shop_tag where id =".$id));
?>
<TABLE border="1" cellspacing="1" width="100%" cellpadding="3" style="border-collapse: collapse;border:0px solid  #A5CF7A" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" bgcolor="#F5F5F5">
   <tr>
    <td height="32" colspan="2" align="center" valign="middle"  class="tit_bg"><b>添加商品分类</b></td>
   </tr>
  <form action="Action.php" method="post" name="Form1" onSubmit="return check()">
  
  
  <INPUT type="hidden" value="<?=$serverinfo[id];?>" name="sid">
  <tr>
    <td width="12%" height="30" align="right" valign="middle">商品ID：</td>
    <td width="88%" valign="middle" class="huise_font">
	<input name="" disabled="true" type="text" id="gamename" size="5"  class="inputclass inputtitle" value="<?=$serverinfo[id];?>" /></td>
  </tr>
  
  <tr>
    <td width="12%" height="30" align="right" valign="middle">商品分类：</td>
    <td width="88%" valign="middle" class="huise_font">
	<input name="shop_tag" type="text" id="gamename" size="50"  class="inputclass inputtitle" value="<?=$serverinfo[shop_tag];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">分类显示位置：</td>
    <td valign="middle" class="huise_font">
        <select name='shop_showline' id="category">
            <option value='1' <?php if($serverinfo[shop_showline]==1) echo "selected='selected'"; ?> >第一行</option>
            <option value='2' <?php if($serverinfo[shop_showline]==2) echo "selected='selected'"; ?>>第二行</option>
            <option value='3' <?php if($serverinfo[shop_showline]==3) echo "selected='selected'"; ?>>第三行</option>
        </select>
    </td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">显示位置：</td>
    <td valign="middle" class="huise_font"><input name="shop_show" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[shop_show];?>" />数字越小越靠前</td>
  </tr>
  <tr>
    <td height="50" colspan="2" align="center" valign="middle">
	    <INPUT type="hidden" value="shoptag_edit" name="go"> 
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
    <td height="32" colspan="2" align="center" valign="middle"  class="tit_bg"><b>添加商品分类</b></td>
   </tr>
  <form action="Action.php" method="post" name="Form1" onSubmit="return check()">
  <tr>
    <td width="12%" height="30" align="right" valign="middle">商品分类：</td>
    <td width="88%" valign="middle" class="huise_font">
	<input name="shop_tag" type="text" id="gamename" size="50"  class="inputclass inputtitle" value="" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">商品显示位置：</td>
    <td valign="middle" class="huise_font">
        <select name='shop_showline' id="category">
            <option value='1' selected='selected' >第一行</option>
            <option value='2' >第二行</option>
            <option value='3' >第三行</option>
        </select>
    </td>
  </tr>
  <tr>
  <tr>
    <td height="30" align="right" valign="middle">显示位置：</td>
    <td valign="middle" class="huise_font"><input name="shop_show" id="website" type="text" size="50" class="inputclass inputtitle" value="1" />数字越小越靠前</td>
  </tr>
    <td height="50" colspan="2" align="center" valign="middle">
	    <INPUT type="hidden" value="shop_tag" name="go"> 
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