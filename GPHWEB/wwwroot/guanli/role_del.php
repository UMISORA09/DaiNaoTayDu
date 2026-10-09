<?php
include 'getfunction.php';
ckdenglu();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<TABLE border="1" cellspacing="1" width="100%" cellpadding="2" style="margin-top:2px;border-collapse: collapse;border:1px solid Silver" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" >

   <tr onmouseover="this.className='mouseon'" onmouseout="this.className='';">    
    <td height="25" align="center" valign="middle"  colspan="10">角色删除恢复管理</td>
  <tr bgcolor="#F1F1F1" style="color:#CC3300;" class="tabletr">
    <td height="22" width="4%" align="center" valign="middle">id</td>
    <td width="8%" align="center" valign="middle">账号</td>
    <td width="6%" align="center" valign="middle">角色名</td>
    <td width="6%" align="center" valign="middle">MD5ID</td>
	<td width="6%" align="center" valign="middle">老角色ID</td>
	<td width="6%" align="center" valign="middle">新角色ID</td>
    <td width="5%" align="center" valign="middle">操作</td>
  </tr>
  
<?php 
 include "../config.php";
 $serverinfo=mysql_query("SELECT * FROM role_dellist");
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
    <td align="center" valign="middle"><?=$row[zhanghao];?></td>
    <td align="center" valign="middle"><?=$row[name];?></td>
    <td align="center" valign="middle"><?=$row[md5id];?></td>
	<td align="center" valign="middle"><?=$row[old_id];?></td>
	<td align="center" valign="middle"><?=$row[new_id];?></td>
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
    $serverinfo=mysql_fetch_array(mysql_query("SELECT * FROM role_dellist where id =".$id));
?>
<TABLE border="1" cellspacing="1" width="100%" cellpadding="3" style="border-collapse: collapse;border:0px solid  #A5CF7A" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" bgcolor="#F5F5F5">
   <tr>
    <td height="32" colspan="2" align="center" valign="middle"  class="tit_bg"><b>编辑角色</b></td>
   </tr>
  <form action="Action.php" method="post" name="Form1" onSubmit="return check()">
   
  <INPUT type="hidden" value="<?=$serverinfo[id];?>" name="sid">
  <tr>
    <td width="12%" height="30" align="right" valign="middle">ID：</td>
    <td width="88%" valign="middle" class="huise_font">
	<input name="" disabled="true" type="text" id="gamename" size="5"  class="inputclass inputtitle" value="<?=$serverinfo[id];?>" /></td>
  </tr>
  
  
  <tr>
    <td width="12%" height="30" align="right" valign="middle">账号：</td>
    <td width="88%" valign="middle" class="huise_font">
	<input name="zhanghao" type="text" id="gamename" size="50"  class="inputclass inputtitle" value="<?=$serverinfo[zhanghao];?>" /></td>
  </tr>
 
  <tr>
    <td height="30" align="right" valign="middle">角色名：</td>
    <td valign="middle" class="huise_font"><input name="name" id="webname" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[name];?>" /></td>
  </tr>  
  
  <tr>
    <td height="30" align="right" valign="middle">MD5ID：</td>
    <td valign="middle" class="huise_font"><input name="md5id" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[md5id];?>" /></td>
  </tr>

  <tr>
    <td height="30" align="right" valign="middle">老角色ID：</td>
    <td valign="middle" class="huise_font"><input name="old_id" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[old_id];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">新角色ID：</td>
    <td valign="middle" class="huise_font"><input name="new_id" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[new_id];?>" /></td>
  </tr>
  <tr>
    <td height="50" colspan="2" align="center" valign="middle">
		    <INPUT type="hidden" value="role_edit" name="go"> 
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
    <td height="32" colspan="2" align="center" valign="middle"  class="tit_bg"><b>删除角色</b></td>
   </tr>
  <form action="Action.php" method="post" name="Form1" onSubmit="return check()">
  <tr>
    <td height="30" align="right" valign="middle">角色名：</td>
    <td valign="middle" class="huise_font"><input name="name" id="webname" type="text" size="50" class="inputclass inputtitle" value="" /></td>
  </tr>  
  <tr>
    <td height="50" colspan="2" align="center" valign="middle">
		    <INPUT type="hidden" value="role_edit" name="go"> 
        <input type="submit" class="btn80_1" name="Submit" id="submit" value="确认修改">
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