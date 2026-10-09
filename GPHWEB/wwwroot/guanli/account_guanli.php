<?php
include 'getfunction.php';
ckdenglu();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<TABLE border="1" cellspacing="1" width="100%" cellpadding="2" style="margin-top:2px;border-collapse: collapse;border:1px solid Silver" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" >

   <tr onmouseover="this.className='mouseon'" onmouseout="this.className='';">    
    <td height="25" align="center" valign="middle"  colspan="10">账号管理</td>
  <tr bgcolor="#F1F1F1" style="color:#CC3300;" class="tabletr">
    <td width="8%" align="center" valign="middle">ID</td>
    <td height="22" width="4%" align="center" valign="middle">账号名称</td>
    <td width="8%" align="center" valign="middle">密码</td>
    <td width="6%" align="center" valign="middle">security</td>
    <td width="6%" align="center" valign="middle">创建时间</td>
	<td width="6%" align="center" valign="middle">最近登录</td>
	<td width="6%" align="center" valign="middle">注册IP</td>
	<td width="6%" align="center" valign="middle">登录IP</td>
    <td width="6%" align="center" valign="middle">现金</td>
    <td width="6%" align="center" valign="middle">总充值现金</td>
    <td width="8%" align="center" valign="middle">积分</td>
    <td width="7%" align="center" valign="middle">元宝</td>
    <td width="8%" align="center" valign="middle">推广积分</td>
    <td width="7%" align="center" valign="middle">总推广数</td>
    <td width="8%" align="center" valign="middle">email</td>
    <td width="7%" align="center" valign="middle">MD5id</td>
    <td width="5%" align="center" valign="middle">操作</td>
  </tr>
  
<?php 
 include "../config.php";
 $serverinfo=mysql_query("SELECT * FROM account");
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
   <td align="center" valign="middle"><?=$row[id];?></td>
    <td height="25" align="center" valign="middle"><?=$row[name];?></td>
    <td align="center" valign="middle"><?=$row[password];?></td>
    <td align="center" valign="middle"><?=$row[security];?></td>
    <td align="center" valign="middle"><?=$row[createtime];?></td>
	<td align="center" valign="middle"><?=$row[logintime];?></td>
	<td align="center" valign="middle"><?=$row[regip];?></td>
	<td align="center" valign="middle"><?=$row[lastip];?></td>
    <td align="center" valign="middle"><?=$row[money];?></td>
	<td align="center" valign="middle"><?=$row[money2];?></td>
    <td align="center" valign="middle"><?=$row[jifen];?></td>
    <td align="center" valign="middle"><?=$row[gold];?></td>
    <td align="center" valign="middle"><?=$row[tg];?></td>
	<td align="center" valign="middle"><?=$row[tg2];?></td>
    <td align="center" valign="middle"><?=$row[email];?></td>
	<td align="center" valign="middle"><?=$row[namemd5id];?></td>
    <td align="center"><a href="?go=edit&s=<?=$row[id];?>" style="color:#1b10f5;" target="_self">编辑</a>|<a href="Action.php?go=account_del&s=<?=$row[id];?>" style="color:#1b10f5;" target="_self">删除</a></td>
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
    $serverinfo=mysql_fetch_array(mysql_query("SELECT * FROM account where id =".$id));
?>
<TABLE border="1" cellspacing="1" width="100%" cellpadding="3" style="border-collapse: collapse;border:0px solid  #A5CF7A" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" bgcolor="#F5F5F5">
   <tr>
    <td height="32" colspan="2" align="center" valign="middle"  class="tit_bg"><b>编辑账号</b></td>
   </tr>
  <form action="Action.php" method="post" name="Form1" onSubmit="return check()">
   
  <INPUT type="hidden" value="<?=$serverinfo[id];?>" name="sid">
  <tr>
    <td width="12%" height="30" align="right" valign="middle">账号ID：</td>
    <td width="88%" valign="middle" class="huise_font">
	<input name="" disabled="true" type="text" id="gamename" size="5"  class="inputclass inputtitle" value="<?=$serverinfo[id];?>" /></td>
  </tr>
  
  
  <tr>
    <td width="12%" height="30" align="right" valign="middle">账号名称：</td>
    <td width="88%" valign="middle" class="huise_font">
	<input name="name" type="text" id="gamename" size="50"  class="inputclass inputtitle" value="<?=$serverinfo[name];?>" /></td>
  </tr>
 
  <tr>
    <td height="30" align="right" valign="middle">密码：</td>
    <td valign="middle" class="huise_font"><input name="password" id="webname" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[password];?>" /></td>
  </tr>  
  
  <tr>
    <td height="30" align="right" valign="middle">security：</td>
    <td valign="middle" class="huise_font"><input name="security" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[security];?>" /></td>
  </tr>

  <tr>
    <td height="30" align="right" valign="middle">创建时间：</td>
    <td valign="middle" class="huise_font"><input name="createtime" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[createtime];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">最近登录：</td>
    <td valign="middle" class="huise_font"><input name="logintime" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[logintime];?>" /></td>
  </tr>


  <tr>
    <td height="30" align="right" valign="middle">注册IP：</td>
    <td valign="middle" class="huise_font"><input name="regip" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[regip];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">登录IP：</td>
    <td valign="middle" class="huise_font"><input name="lastip" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[lastip];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">现金：</td>
    <td valign="middle" class="huise_font"><input name="money" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[money];?>" /></td>
  </tr>  
  <tr>
    <td height="30" align="right" valign="middle">总充值现金：</td>
    <td valign="middle" class="huise_font"><input name="money2" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[money2];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">积分：</td>
    <td valign="middle" class="huise_font"><input name="jifen" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[jifen];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">元宝：</td>
    <td valign="middle" class="huise_font"><input name="gold" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[gold];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">推广积分：</td>
    <td valign="middle" class="huise_font"><input name="tg" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[tg];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">总推广数：</td>
    <td valign="middle" class="huise_font"><input name="tg2" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[tg2];?>" /></td>
  </tr>  
  <tr>
    <td height="30" align="right" valign="middle">email：</td>
    <td valign="middle" class="huise_font"><input name="email" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[email];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">MD5id：</td>
    <td valign="middle" class="huise_font"><input name="namemd5id" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[namemd5id];?>" /></td>
  </tr>
  
  <tr>
    <td height="50" colspan="2" align="center" valign="middle">
		    <INPUT type="hidden" value="account_edit" name="go"> 
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
    <td height="32" colspan="2" align="center" valign="middle"  class="tit_bg"><b>添加账号（停用）</b></td>
   </tr>
  <form action="Action.php" method="post" name="Form1" onSubmit="return check()">
   
  <tr>
    <td width="12%" height="30" align="right" valign="middle">账号名称：</td>
    <td width="88%" valign="middle" class="huise_font">
	<input name="name" type="text" id="gamename" size="50"  class="inputclass inputtitle" value="" /></td>
  </tr>
 
  <tr>
    <td height="30" align="right" valign="middle">密码：</td>
    <td valign="middle" class="huise_font"><input name="password" id="webname" type="text" size="50" class="inputclass inputtitle" value="" /></td>
  </tr>  
  
  <tr>
    <td height="30" align="right" valign="middle">security：</td>
    <td valign="middle" class="huise_font"><input name="security" id="website" type="text" size="50" class="inputclass inputtitle" value="" /></td>
  </tr>

  <tr>
    <td height="30" align="right" valign="middle">创建时间：</td>
    <td valign="middle" class="huise_font"><input name="createtime" id="website" type="text" size="50" class="inputclass inputtitle" value="" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">最近登录：</td>
    <td valign="middle" class="huise_font"><input name="logintime" id="website" type="text" size="50" class="inputclass inputtitle" value="" /></td>
  </tr>


  <tr>
    <td height="30" align="right" valign="middle">注册IP：</td>
    <td valign="middle" class="huise_font"><input name="regip" id="website" type="text" size="50" class="inputclass inputtitle" value="" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">登录IP：</td>
    <td valign="middle" class="huise_font"><input name="lastip" id="website" type="text" size="50" class="inputclass inputtitle" value="" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">现金：</td>
    <td valign="middle" class="huise_font"><input name="money" id="website" type="text" size="50" class="inputclass inputtitle" value="" /></td>
  </tr>  
  <tr>
    <td height="30" align="right" valign="middle">总充值现金：</td>
    <td valign="middle" class="huise_font"><input name="money2" id="website" type="text" size="50" class="inputclass inputtitle" value="" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">积分：</td>
    <td valign="middle" class="huise_font"><input name="jifen" id="website" type="text" size="50" class="inputclass inputtitle" value="" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">元宝：</td>
    <td valign="middle" class="huise_font"><input name="gold" id="website" type="text" size="50" class="inputclass inputtitle" value="" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">推广积分：</td>
    <td valign="middle" class="huise_font"><input name="tg" id="website" type="text" size="50" class="inputclass inputtitle" value="" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">总推广数：</td>
    <td valign="middle" class="huise_font"><input name="tg2" id="website" type="text" size="50" class="inputclass inputtitle" value="" /></td>
  </tr>  
  <tr>
    <td height="30" align="right" valign="middle">email：</td>
    <td valign="middle" class="huise_font"><input name="email" id="website" type="text" size="50" class="inputclass inputtitle" value="" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">MD5id：</td>
    <td valign="middle" class="huise_font"><input name="namemd5id" id="website" type="text" size="50" class="inputclass inputtitle" value="" /></td>
  </tr>
  
  <tr>
    <td height="50" colspan="2" align="center" valign="middle">
		    <INPUT type="hidden" value="account_add" name="go"> 
        <input type="submit" class="btn80_1" name="Submit" id="submit" value="确认添加">
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