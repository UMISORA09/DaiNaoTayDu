<?php
include 'getfunction.php';
ckdenglu();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<TABLE border="1" cellspacing="1" width="100%" cellpadding="2" style="margin-top:2px;border-collapse: collapse;border:1px solid Silver" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" >

   <tr onmouseover="this.className='mouseon'" onmouseout="this.className='';">    
    <td height="25" align="center" valign="middle"  colspan="10">商品管理</td>
  <tr bgcolor="#F1F1F1" style="color:#CC3300;" class="tabletr">
    <td height="22" width="4%" align="center" valign="middle">商品名称</td>
    <td width="8%" align="center" valign="middle">商品分类</td>
    <td width="6%" align="center" valign="middle">商品数量</td>
    <td width="6%" align="center" valign="middle">商品代码</td>
    <td width="6%" align="center" valign="middle">商品介绍</td>
    <td width="6%" align="center" valign="middle">商品价格</td>
    <td width="8%" align="center" valign="middle">价格类别</td>
    <td width="7%" align="center" valign="middle">商品图片</td>
	<td width="7%" align="center" valign="middle">显示位置</td>
    <td width="5%" align="center" valign="middle">操作</td>
  </tr>
  
<?php 
 include "../config.php";
 $serverinfo=mysql_query("SELECT * FROM shop_list");
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
    <td height="25" align="center" valign="middle"><?=$row[shop_name];?></td>
    <td align="center" valign="middle"><?=$row[shop_tag];?></td>
    <td align="center" valign="middle"><?=$row[shop_num];?></td>
    <td align="center" valign="middle"><?=stripslashes($row[shop_code]);?></td>
    <td align="center" valign="middle"><?=$row[shop_content];?></td>
    <td align="center" valign="middle"><?=$row[shop_prick];?></td>
    <td align="center" valign="middle"><?=$row[shop_prick_type];?></td>
    <td align="center" valign="middle"><?=$row[shop_pic];?></td>
	<td align="center" valign="middle"><?=$row[shop_show];?></td>
    <td align="center"><a href="?go=edit&s=<?=$row[id];?>" style="color:#1b10f5;" target="_self">编辑</a>|<a href="Action.php?go=del_shop&s=<?=$row[id];?>" style="color:#1b10f5;" target="_self">删除</a></td>
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
    $serverinfo=mysql_fetch_array(mysql_query("SELECT * FROM shop_list where id =".$id));
?>
<TABLE border="1" cellspacing="1" width="100%" cellpadding="3" style="border-collapse: collapse;border:0px solid  #A5CF7A" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" bgcolor="#F5F5F5">
   <tr>
    <td height="32" colspan="2" align="center" valign="middle"  class="tit_bg"><b>编辑商品</b></td>
   </tr>
  <form action="Action.php" method="post" name="Form1" onSubmit="return check()">
   
  <INPUT type="hidden" value="<?=$serverinfo[id];?>" name="sid">
  <tr>
    <td width="12%" height="30" align="right" valign="middle">商品ID：</td>
    <td width="88%" valign="middle" class="huise_font">
	<input name="" disabled="true" type="text" id="gamename" size="5"  class="inputclass inputtitle" value="<?=$serverinfo[id];?>" /></td>
  </tr>
  
  
  <tr>
    <td width="12%" height="30" align="right" valign="middle">商品名称：</td>
    <td width="88%" valign="middle" class="huise_font">
	<input name="shop_name" type="text" id="gamename" size="50"  class="inputclass inputtitle" value="<?=$serverinfo[shop_name];?>" /></td>
  </tr>
 
  <tr>
    <td height="30" align="right" valign="middle">商品分类(可以用逗号隔开)：</td>
    <td valign="middle" class="huise_font"><input name="shop_tag" id="webname" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[shop_tag];?>" /></td>
  </tr>  
  
  <tr>
    <td height="30" align="right" valign="middle">商品数量：</td>
    <td valign="middle" class="huise_font"><input name="shop_num" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[shop_num];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">物品CODE：</td>
    <td valign="middle" class="huise_font"><input name="shop_code" id="website" type="text" size="200" class="inputclass inputtitle" value='<?=stripslashes($serverinfo[shop_code]);?>' /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">介绍说明：</td>
    <td valign="middle" class="huise_font"><input name="shop_content" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[shop_content];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">出售价格：</td>
    <td valign="middle" class="huise_font"><input name="shop_prick" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[shop_prick];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">价格类型：</td>
    <td valign="middle" class="huise_font">
        <select name='shop_prick_type' id="category">
            <option value='money' <?php if($serverinfo[shop_prick_type]==money) echo "selected='selected'"; ?> >现金</option>
            <option value='jifen' <?php if($serverinfo[shop_prick_type]==jifen) echo "selected='selected'"; ?>>积分</option>
            <option value='gold' <?php if($serverinfo[shop_prick_type]==gold) echo "selected='selected'"; ?>>元宝</option>
			<option value='tg' <?php if($serverinfo[shop_prick_type]==tg) echo "selected='selected'"; ?>>推广</option>
        </select>
    </td>
  </tr>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">商品图片：</td>
    <td valign="middle" class="huise_font"><input name="shop_pic" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[shop_pic];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">显示位置：</td>
    <td valign="middle" class="huise_font"><input name="shop_show" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[shop_show];?>" />数字越小越靠前</td>
  </tr>
  <tr>
    <td height="50" colspan="2" align="center" valign="middle">
		    <INPUT type="hidden" value="shop_edit" name="go"> 
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
    <td height="32" colspan="2" align="center" valign="middle"  class="tit_bg"><b>添加商品</b></td>
   </tr>
  <form action="Action.php" method="post" name="Form1" onSubmit="return check()">
  <tr>
    <td width="12%" height="30" align="right" valign="middle">商品名称：</td>
    <td width="88%" valign="middle" class="huise_font">
	<input name="shop_name" type="text" id="gamename" size="50"  class="inputclass inputtitle" value="" /></td>
  </tr>
 
  <tr>
    <td height="30" align="right" valign="middle">商品分类(可以用逗号隔开)：</td>
    <td valign="middle" class="huise_font"><input name="shop_tag" id="webname" type="text" size="50" class="inputclass inputtitle" value="" /></td>
  </tr>  
  
  <tr>
    <td height="30" align="right" valign="middle">商品数量：</td>
    <td valign="middle" class="huise_font"><input name="shop_num" id="website" type="text" size="50" class="inputclass inputtitle" value="1" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">物品CODE：</td>
    <td valign="middle" class="huise_font"><input name="shop_code" id="website" type="text" size="200" class="inputclass inputtitle" value="" />[{"attributes":"{\"fjattrstr\":\"{}\",\"jjfailcount\":0,\"qhcount\":3,\"qhxingxing\":\"[[1,1],[2,1],[3,1]]\"}","bind":1,"expireTime":0,"expired":false,"goodsCount":1,"goodsId":"zj0410","itemLevel":40,"notice":false,"rareLevel":2,"slotNum":0}]</td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">介绍说明：</td>
    <td valign="middle" class="huise_font"><input name="shop_content" id="website" type="text" size="50" class="inputclass inputtitle" value="" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">出售价格：</td>
    <td valign="middle" class="huise_font"><input name="shop_prick" id="website" type="text" size="50" class="inputclass inputtitle" value="" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">价格类型：</td>
    <td valign="middle" class="huise_font">
        <select name='shop_prick_type' id="category">
            <option value='money' selected='selected'>现金</option>
            <option value='jifen'>积分</option>
            <option value='gold'>元宝</option>
			<option value='tg'>推广</option>
        </select>
    </td>
  </tr>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">商品图片：</td>
    <td valign="middle" class="huise_font"><input name="shop_pic" id="website" type="text" size="50" class="inputclass inputtitle" value="images/shop.jpg" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">显示位置：</td>
    <td valign="middle" class="huise_font"><input name="shop_show" id="website" type="text" size="50" class="inputclass inputtitle" value="1" />数字越小越靠前</td>
  </tr>
  <tr>
    <td height="50" colspan="2" align="center" valign="middle">
		    <INPUT type="hidden" value="shop_add" name="go"> 
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