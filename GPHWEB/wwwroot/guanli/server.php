<?php
include 'getfunction.php';
ckdenglu();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<TABLE border="1" cellspacing="1" width="100%" cellpadding="2" style="margin-top:2px;border-collapse: collapse;border:1px solid Silver" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" >

   <tr onmouseover="this.className='mouseon'" onmouseout="this.className='';">    
    <td height="25" align="center" valign="middle" colspan="10">新区管理</td>
  <tr bgcolor="#F1F1F1" style="color:#CC3300;" class="tabletr">
    <td height="22" width="4%" align="center" valign="middle">新区名称</td>
	    <td width="8%" align="center" valign="middle">电信资源</td>
	<td width="8%" align="center" valign="middle">网通资源</td>
    <td width="8%" align="center" valign="middle">电信登陆IP</td>
	<td width="8%" align="center" valign="middle">网通登陆IP</td>
    <td width="6%" align="center" valign="middle">登陆端口</td>
    <td width="6%" align="center" valign="middle">数据库地址</td>
    <td width="6%" align="center" valign="middle">数据库账号</td>
    <td width="8%" align="center" valign="middle">数据库密码</td>
    <td width="7%" align="center" valign="middle">角色数据库</td>
    <td width="5%" align="center" valign="middle">充值端口</td>
	<td width="6%" align="center" valign="middle">邮件端口</td>

    <td width="5%" align="center" valign="middle">操作</td>
  </tr>
  
 <?php 
 include "../config.php";
 $serverinfo=mysql_query("SELECT * FROM server");
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
    <td height="25" align="center" valign="middle"><?=$row[servername];?></td>
		    <td align="center" valign="middle"><?=$row[resdx];?></td>
	    <td align="center" valign="middle"><?=$row[reswt];?></td>
	    <td align="center" valign="middle"><?=$row[gameipdx];?></td>
    <td align="center" valign="middle"><?=$row[gameipwt];?></td>
    <td align="center" valign="middle"><?=$row[loginport];?></td>
    <td align="center" valign="middle"><?=$row[mysqlip];?></td>
    <td align="center" valign="middle"><?=$row[mysqlname];?></td>
    <td align="center" valign="middle"><?=$row[mysqlpass];?></td>
    <td align="center" valign="middle"><?=$row[mysqlroledb];?></td>
	<td align="center" valign="middle"><?=$row[czport];?></td>
    <td align="center" valign="middle"><?=$row[yjport];?></td>

    <td align="center"><a href="?go=edit&s=<?=$row[id];?>" style="color:#1b10f5;" target="_self">编辑</a>|<a href="Action.php?go=del_server&s=<?=$row[id];?>" style="color:#1b10f5;" target="_self">删除</a></td>
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
    $serverinfo=mysql_fetch_array(mysql_query("SELECT * FROM server where id =".$id));
?>
<TABLE border="1" cellspacing="1" width="100%" cellpadding="3" style="border-collapse: collapse;border:0px solid  #A5CF7A" bordercolor="#E2E2E2" bordercolorlight="#E2E2E2" bordercolordark="#E2E2E2" align="center" bgcolor="#F5F5F5">
   <tr>
    <td height="32" colspan="2" align="center" valign="middle"  class="tit_bg"><b>编辑新区</b></td>
   </tr>

  <form action="Action.php" method="post" name="Form1" onSubmit="return check()">
    <INPUT type="hidden" value="<?=$serverinfo[id];?>" name="sid">
  <tr>
    <td width="12%" height="30" align="right" valign="middle">新区ID：</td>
    <td width="88%" valign="middle" class="huise_font">
	<input name="" disabled="true" type="text" id="gamename" size="5"  class="inputclass inputtitle" value="<?=$serverinfo[id];?>" /></td>
  </tr>
  
  
  <tr>
    <td width="12%" height="30" align="right" valign="middle">新区名称：</td>
    <td width="88%" valign="middle" class="huise_font">
	<input name="server_name" type="text" id="gamename" size="50"  class="inputclass inputtitle" value="<?=$serverinfo[servername];?>" /></td>
  </tr>
   <tr>
    <td height="30" align="right" valign="middle">游戏资源目录(电信)：</td>
    <td valign="middle" class="huise_font"><input name="resdx" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[resdx];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">游戏资源目录(网通)：</td>
    <td valign="middle" class="huise_font"><input name="reswt" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[reswt];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">登陆地址(电信IP)：</td>
    <td valign="middle" class="huise_font"><input name="gameipdx" id="webname" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[gameipdx];?>" /></td>
  </tr>  
    <tr>
    <td height="30" align="right" valign="middle">登陆地址(网通IP)：</td>
    <td valign="middle" class="huise_font"><input name="gameipwt" id="webname" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[gameipwt];?>" /></td>
  </tr>  
  <tr>
    <td height="30" align="right" valign="middle">登陆端口：</td>
    <td valign="middle" class="huise_font"><input name="server_port" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[loginport];?>" /></td>
  </tr>

  <tr>
    <td height="30" align="right" valign="middle">MYSQL地址(IP)：</td>
    <td valign="middle" class="huise_font"><input name="mysql_ip" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[mysqlip];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">MYSQL账号：</td>
    <td valign="middle" class="huise_font"><input name="mysql_user" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[mysqlname];?>" /></td>
  </tr>
   <tr>
    <td height="30" align="right" valign="middle">MYSQL密码：</td>
    <td valign="middle" class="huise_font"><input name="mysql_pass" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[mysqlpass];?>" /></td>
  </tr>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">角色数据库：</td>
    <td valign="middle" class="huise_font"><input name="mysql_roledb" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[mysqlroledb];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">充值端口：</td>
    <td valign="middle" class="huise_font"><input name="czport" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[czport];?>" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">邮件端口：</td>
    <td valign="middle" class="huise_font"><input name="yjport" id="website" type="text" size="50" class="inputclass inputtitle" value="<?=$serverinfo[yjport];?>" /></td>
  </tr>
  <tr>
    <td height="50" colspan="2" align="center" valign="middle">
	    <INPUT type="hidden" value="edit_server" name="go"> 
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
    <td height="32" colspan="2" align="center" valign="middle"  class="tit_bg"><b>添加新区</b></td>
   </tr>
  <form action="Action.php" method="post" name="Form1" onSubmit="return check()">
  <tr>
    <td width="12%" height="30" align="right" valign="middle">新区名称：</td>
    <td width="88%" valign="middle" class="huise_font">
	<input name="server_name" type="text" id="gamename" size="50"  class="inputclass inputtitle" value="一区" /></td>
  </tr>
  </tr>
   <tr>
    <td height="30" align="right" valign="middle">游戏资源目录(电信)：</td>
    <td valign="middle" class="huise_font"><input name="resdx" id="website" type="text" size="50" class="inputclass inputtitle" value="http://127.0.0.1:8089/res/" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">游戏资源目录(网通)：</td>
    <td valign="middle" class="huise_font"><input name="reswt" id="website" type="text" size="50" class="inputclass inputtitle" value="http://127.0.0.1:8089/res/" /></td>
  </tr>
<tr>
    <td height="30" align="right" valign="middle">登陆地址(电信IP)：</td>
    <td valign="middle" class="huise_font"><input name="gameipdx" id="webname" type="text" size="50" class="inputclass inputtitle" value="127.0.0.1" /></td>
  </tr>  
    <tr>
    <td height="30" align="right" valign="middle">登陆地址(网通IP)：</td>
    <td valign="middle" class="huise_font"><input name="gameipwt" id="webname" type="text" size="50" class="inputclass inputtitle" value="127.0.0.1" /></td>
  </tr>  
  
  <tr>
    <td height="30" align="right" valign="middle">登陆端口：</td>
    <td valign="middle" class="huise_font"><input name="server_port" id="website" type="text" size="50" class="inputclass inputtitle" value="8008" /></td>
  </tr>

  <tr>
    <td height="30" align="right" valign="middle">MYSQL地址(IP)：</td>
    <td valign="middle" class="huise_font"><input name="mysql_ip" id="website" type="text" size="50" class="inputclass inputtitle" value="127.0.0.1" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">MYSQL账号：</td>
    <td valign="middle" class="huise_font"><input name="mysql_user" id="website" type="text" size="50" class="inputclass inputtitle" value="root" /></td>
  </tr>
   <tr>
    <td height="30" align="right" valign="middle">MYSQL密码：</td>
    <td valign="middle" class="huise_font"><input name="mysql_pass" id="website" type="text" size="50" class="inputclass inputtitle" value="123456" /></td>
  </tr>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">角色数据库：</td>
    <td valign="middle" class="huise_font"><input name="mysql_roledb" id="website" type="text" size="50" class="inputclass inputtitle" value="dntg" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">充值端口：</td>
    <td valign="middle" class="huise_font"><input name="czport" id="website" type="text" size="50" class="inputclass inputtitle" value="8008" /></td>
  </tr>
  <tr>
    <td height="30" align="right" valign="middle">邮件端口：</td>
    <td valign="middle" class="huise_font"><input name="yjport" id="website" type="text" size="50" class="inputclass inputtitle" value="7183" /></td>
  </tr>
  <tr>
    <td height="50" colspan="2" align="center" valign="middle">
	    <INPUT type="hidden" value="add_server" name="go"> 
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
