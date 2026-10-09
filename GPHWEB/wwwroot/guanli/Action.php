<?php
include '../config.php';
include 'getfunction.php';


if ($_GET[go]=="logout") 
{
   setcookie("admin", "", time()-36000);
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('您已经安全退出!');location.href='./';</script>";
   exit;
}

if ($_POST[go]=="repass")
{
   ckdenglu();
   $password=addslashes(trim($_POST['password']));
   $newpassword=addslashes(trim($_POST['newpassword']));
    $newpassword2=addslashes(trim($_POST['newpassword2']));
   if (strlen($newpassword)<3)
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('请输入密码！密码太短了少于3位！');history.go(-1);</script>";
      exit;
   }
   if($newpassword!=$newpassword2)
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('两次输入密码不一样，请重新输入');history.go(-1);</script>";
      exit;
   }
   $userinfo = mysql_fetch_array(mysql_query("SELECT * FROM admin_user WHERE admin_name='".$GLOBALS["gname"]."' AND admin_pass='".md5($password)."'"));
   if ($userinfo==false)
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('原来的密码错误，请重新输入');history.go(-1);</script>";
      exit;
   } else 
   {
	  if(mysql_query("update admin_user set admin_pass='".md5($newpassword)."' WHERE admin_name='".$GLOBALS["gname"]."'"))
	  {
	        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	        echo "<script>alert('修改密码成功！，请重新登陆！');location.href='login.php'</script>";
			exit;
	  }
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	  echo "<script>alert('修改密码失败！');history.go(-1);</script>";
	  exit;
   }
}


if ($_POST[go]=="login")
{
   $user=addslashes(trim($_POST['username']));
   $password=addslashes(trim($_POST['password']));
   if (strlen($user)<3)
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('用户名不能少于3位，请重新输入!');history.go(-1);</script>";
      exit;
   }
   if (strlen($password)<3)
   {
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      echo "<script>alert('请输入密码！密码太短了少于3位！');history.go(-1);</script>";
      exit;
   }
   $userinfo = mysql_fetch_array(mysql_query("SELECT * FROM admin_user WHERE admin_name='".$user."' AND admin_pass='".md5($password)."'"));
   if (empty($userinfo))
   {
   
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	  echo "<script>alert('用户名或密码错误，请重新输入');history.go(-1);</script>";
      exit;
   } else 
   {
      $user=strtolower($user);
	  $password=strtolower(md5($password));
      setcookie("admin",$user.':'.md5($user.$password),time()+36000);
//	  mysql_query("updata account set logintime=now() WHERE name='".$user."'");
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	  echo "<script>location.href='index.php'</script>";
	  exit;
   }
}

if ($_POST[go]=="add_server")
{
  ckdenglu();
  $server_name=addslashes(trim($_POST['server_name']));
  $gameipdx=addslashes(trim($_POST['gameipdx']));
  $gameipwt=addslashes(trim($_POST['gameipwt']));
  $resdx=addslashes(trim($_POST['resdx']));
  $reswt=addslashes(trim($_POST['reswt']));
  $server_port=addslashes(trim($_POST['server_port']));
  $mysql_ip=addslashes(trim($_POST['mysql_ip']));
  $mysql_user=addslashes(trim($_POST['mysql_user']));
  $mysql_pass=addslashes(trim($_POST['mysql_pass']));
  $mysql_roledb=addslashes(trim($_POST['mysql_roledb']));
  $yjport=addslashes(trim($_POST['yjport']));
  $czport=addslashes(trim($_POST['czport']));
  if( mysql_query("INSERT INTO server (servername,mysqlip,mysqlname,mysqlpass,mysqlroledb,yjport,gameipdx,loginport,czport,gameipwt,resdx,reswt) VALUES ('".$server_name."','".$mysql_ip."','".$mysql_user."','".$mysql_pass."','".$mysql_roledb."','".$yjport."','".$gameipdx."',".$server_port.",'".$czport."','".$gameipwt."','".$resdx."','".$reswt."')")==true)
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('添加新区成功！');location.href='server.php'</script>";
   exit;
  }else
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('添加新区失败！');location.href='server.php'</script>";
   exit;
  }
}

if ($_POST[go]=="libao_add")
{
  ckdenglu();
  $libao_name=addslashes(trim($_POST['libao_name']));
  $libao_level=addslashes(trim($_POST['libao_level']));
  $libao_code=addslashes(trim($_POST['libao_code']));
  $libao_coin=addslashes(trim($_POST['libao_coin']));
  $libao_gold=addslashes(trim($_POST['libao_gold']));
  $libao_content=addslashes(trim($_POST['libao_content']));
  $libao_show=addslashes(trim($_POST['libao_show']));
  if( mysql_query("INSERT INTO libao_list (libao_name,libao_level,libao_code,libao_coin,libao_gold,libao_content,libao_show) VALUES ('".$libao_name."','".$libao_level."','".$libao_code."','".$libao_coin."','".$libao_gold."','".$libao_content."','".$libao_show."')")==true)
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('添加礼包成功！');location.href='libao_add.php'</script>";
   exit;
  }else
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('添加礼包失败！');location.href='libao_add.php'</script>";
   exit;
  }
}

if ($_POST[go]=="shop_add")
{
  ckdenglu();
  $shop_name=addslashes(trim($_POST['shop_name']));
  $shop_tag=addslashes(trim($_POST['shop_tag']));
  $shop_num=addslashes(trim($_POST['shop_num']));
  $shop_code=addslashes(trim($_POST['shop_code']));
  $shop_code=str_replace("｜","|",$shop_code);
  $shop_content=addslashes(trim($_POST['shop_content']));
  $shop_prick=addslashes(trim($_POST['shop_prick']));
  $shop_prick_type=addslashes(trim($_POST['shop_prick_type']));
  $shop_pic=addslashes(trim($_POST['shop_pic']));
  $shop_show=addslashes(trim($_POST['shop_show']));
  if( mysql_query("INSERT INTO shop_list (shop_name,shop_tag,shop_num,shop_code,shop_content,shop_prick,shop_prick_type,shop_pic,shop_show) VALUES ('".$shop_name."','".$shop_tag."',".$shop_num.",'".$shop_code."','".$shop_content."',".$shop_prick.",'".$shop_prick_type."','".$shop_pic."',".$shop_show.")")==true)
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('添加商品成功！');location.href='shop_add.php'</script>";
   exit;
  }else
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('添加商品失败！');location.href='shop_add.php'</script>";
   exit;
  }
}

if ($_POST[go]=="shop_tag")
{
  ckdenglu();
  $shop_tag=addslashes(trim($_POST['shop_tag']));
  $shop_showline=addslashes(trim($_POST['shop_showline']));
  $shop_show=addslashes(trim($_POST['shop_show']));
  if( mysql_query("INSERT INTO shop_tag (shop_tag,shop_showline,shop_show) VALUES ('".$shop_tag."',".$shop_showline.",".  $shop_show.")")==true)
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('添加商品分类成功！');location.href='shop_tag.php'</script>";
   exit;
  }else
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('添加商品分类失败！');location.href='shop_tag.php'</script>";
   exit;
  }
}
if ($_GET[go]=="del_server")
{
  ckdenglu();
  $id=addslashes(trim($_GET['s']));
  if( mysql_query("delete from server where id =".$id)==true)
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('删除新区成功！');location.href='server.php'</script>";
   exit;
  }else
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('删除新区失败！');location.href='server.php'</script>";
   exit;
  }
  
}

if ($_POST[go]=="edit_server")
{
  ckdenglu();
  $sid=addslashes(trim($_POST['sid']));
  $server_name=addslashes(trim($_POST['server_name']));
  $gameipdx=addslashes(trim($_POST['gameipdx']));
  $gameipwt=addslashes(trim($_POST['gameipwt']));
  $resdx=addslashes(trim($_POST['resdx']));
  $reswt=addslashes(trim($_POST['reswt']));
  $server_port=addslashes(trim($_POST['server_port']));
  $mysql_ip=addslashes(trim($_POST['mysql_ip']));
  $mysql_user=addslashes(trim($_POST['mysql_user']));
  $mysql_pass=addslashes(trim($_POST['mysql_pass']));
  $mysql_roledb=addslashes(trim($_POST['mysql_roledb']));
  $yjport=addslashes(trim($_POST['yjport']));
  $czport=addslashes(trim($_POST['czport']));
  
  if(mysql_query("update server set servername='".$server_name."',gameipdx='".$gameipdx."',gameipwt='".$gameipwt."',resdx='".$resdx."',reswt='".$reswt."',loginport=".$server_port.",yjport=".$yjport.",mysqlip='".$mysql_ip."',mysqlname='".$mysql_user."',mysqlpass='".$mysql_pass."',mysqlroledb='".$mysql_roledb."',czport=".$czport." WHERE id=".$sid)==true)
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('编辑新区成功！');location.href='server.php'</script>";
   exit;
  }else
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('编辑新区失败！');location.href='server.php'</script>";
   exit;
  }
}

if ($_POST[go]=="account_chongzhi")
{
  ckdenglu();
  $name=addslashes(trim($_POST['account']));
  $money=addslashes(trim($_POST['money']));
  $jifen=addslashes(trim($_POST['jifen']));
  $gold=addslashes(trim($_POST['gold']));
  $tg=addslashes(trim($_POST['tg']));
  $namemd5id=addslashes(trim($_POST['namemd5id']));
  
  if(mysql_query("update account set money=".$money."+money,jifen=".$jifen."+jifen,gold=".$gold."+gold,tg=".$tg."+tg WHERE name='".$name."'")==true)
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('充值账号成功！');history.go(-1);</script>";
   exit;
  }else
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('充值账号失败！');history.go(-1);</script>";
   exit;
  }
}


if ($_POST[go]=="account_edit")
{
  ckdenglu();
  $sid=addslashes(trim($_POST['sid']));
  $name=addslashes(trim($_POST['name']));
  $password=addslashes(trim($_POST['password']));
  $security=addslashes(trim($_POST['security']));
  $createtime=addslashes(trim($_POST['createtime']));
  $logintime=addslashes(trim($_POST['logintime']));
  $regip=addslashes(trim($_POST['regip']));
  $lastip=addslashes(trim($_POST['lastip']));
  $money=addslashes(trim($_POST['money']));
  $money2=addslashes(trim($_POST['money2']));
  $jifen=addslashes(trim($_POST['jifen']));
  $gold=addslashes(trim($_POST['gold']));
  $email=addslashes(trim($_POST['email']));
  $tg=addslashes(trim($_POST['tg']));
  $tg2=addslashes(trim($_POST['tg2']));
  $namemd5id=addslashes(trim($_POST['namemd5id']));
  
  if(mysql_query("update account set name='".$name."',password='".$password."',security=".$security.",createtime='".$createtime."',logintime='".$logintime."',regip='".$regip."',lastip='".$lastip."',money='".$money."',money2='".$money2."',jifen='".$jifen."',gold='".$gold."',email='".$email."',tg='".$tg."',tg2='".$tg2."',namemd5id='".$namemd5id."' WHERE id=".$sid)==true)
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('编辑账号成功！');history.go(-1);</script>";
   exit;
  }else
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('编辑账号失败！');history.go(-1);</script>";
   exit;
  }
}

if ($_POST[go]=="libao_edit")
{
  ckdenglu();
  $libao_name=addslashes(trim($_POST['libao_name']));
  $libao_level=addslashes(trim($_POST['libao_level']));
  $libao_code=addslashes(trim($_POST['libao_code']));
  $libao_coin=addslashes(trim($_POST['libao_coin']));
  $libao_gold=addslashes(trim($_POST['libao_gold']));
  $libao_content=addslashes(trim($_POST['libao_content']));
  $libao_show=addslashes(trim($_POST['libao_show']));
  $sid=addslashes(trim($_POST['sid']));
  
  
   if(mysql_query("update libao_list set libao_name='".$libao_name."',libao_level='".$libao_level."',libao_code='".$libao_code."',libao_coin='".$libao_coin."',libao_gold='".$libao_gold."',libao_content='".$libao_content."',libao_show='".$libao_show."' WHERE id=".$sid)==true)
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('修改礼包成功！');location.href='libao_add.php'</script>";
   exit;
  }else
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('修改礼包失败！');location.href='libao_add.php'</script>";
   exit;
  }
}


if ($_POST[go]=="shop_edit")
{
  ckdenglu();
  $sid=addslashes(trim($_POST['sid']));
  $shop_name=addslashes(trim($_POST['shop_name']));
  $shop_tag=addslashes(trim($_POST['shop_tag']));
  $shop_num=addslashes(trim($_POST['shop_num']));
  $shop_code=addslashes(trim($_POST['shop_code']));
  $shop_code=str_replace("｜","|",$shop_code);
  $shop_content=addslashes(trim($_POST['shop_content']));
  $shop_prick=addslashes(trim($_POST['shop_prick']));
  $shop_prick_type=addslashes(trim($_POST['shop_prick_type']));
  $shop_pic=addslashes(trim($_POST['shop_pic']));
  $shop_show=addslashes(trim($_POST['shop_show']));
  if(mysql_query("update shop_list set shop_name='".$shop_name."',shop_tag='".$shop_tag."',shop_num=".$shop_num.",shop_code='".$shop_code."',shop_content='".$shop_content."',shop_prick=".$shop_prick.",shop_prick_type='".$shop_prick_type."',shop_pic='".$shop_pic."',shop_show=".$shop_show." WHERE id=".$sid)==true)
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('编辑商品成功！');location.href='shop_add.php'</script>";
   exit;
  }else
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('编辑商品失败！');location.href='shop_add.php'</script>";
   exit;
  }
}

if ($_GET[go]=="del_libao")
{
  ckdenglu();
  $id=addslashes(trim($_GET['s']));
  if( mysql_query("delete from libao_list where id =".$id)==true)
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('删除礼包成功！');location.href='libao_add.php'</script>";
   exit;
  }else
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('删除礼包失败！');location.href='libao_add.php'</script>";
   exit;
  }
  
}
if ($_GET[go]=="account_del")
{
  ckdenglu();
  $id=addslashes(trim($_GET['s']));
  if( mysql_query("delete from account where id =".$id)==true)
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('删除账号成功！');history.go(-1);</script>";
   exit;
  }else
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('删除账号失败！');history.go(-1);</script>";
   exit;
  }
  
}

if ($_GET[go]=="del_shop")
{
  ckdenglu();
  $id=addslashes(trim($_GET['s']));
  if( mysql_query("delete from shop_list where id =".$id)==true)
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('删除商品成功！');location.href='shop_add.php'</script>";
   exit;
  }else
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('删除商品失败！');location.href='shop_add.php'</script>";
   exit;
  }
  
}
if ($_GET[go]=="del_shoptag")
{
  ckdenglu();
  $id=addslashes(trim($_GET['s']));
  if( mysql_query("delete from shop_tag where id =".$id)==true)
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('删除商品分类成功！');location.href='shop_tag.php'</script>";
   exit;
  }else
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('删除商品分类失败！');location.href='shop_tag.php'</script>";
   exit;
  }
  
}


if ($_POST[go]=="shoptag_edit")
{
  ckdenglu();
  $sid=addslashes(trim($_POST['sid']));
  $shop_tag=addslashes(trim($_POST['shop_tag']));
  $shop_showline=addslashes(trim($_POST['shop_showline']));
  $shop_show=addslashes(trim($_POST['shop_show']));
  if(mysql_query("update shop_tag set shop_tag='".$shop_tag."',shop_showline=".$shop_showline.",shop_show=".$shop_show." WHERE id=".$sid)==true)
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('编辑商品分类成功！');location.href='shop_tag.php'</script>";
   exit;
  }else
  {
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('编辑商品分类失败！');location.href='shop_tag.php'</script>";
   exit;
  }
}
if ($_POST[go]=="add_mail")
{
  ckdenglu();
  $sid = intval($_POST['sid']);
  $role_name = trim($_POST['role_name']);
  $mail_name = trim($_POST['mail_name']);
  $mail_content = trim($_POST['mail_content']);
  $mail_gold = intval($_POST['mail_gold']);
  $mail_coin = intval($_POST['mail_coin']);
  $mail_code = trim($_POST['mail_code']);
  $mail_count = isset($_POST['mail_count']) ? intval($_POST['mail_count']) : 1;
  if($mail_count <= 0) $mail_count = 1;
  
  if(empty($role_name))
  {
     echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
     echo "<script>alert('Vui lòng nhập tên nhân vật!');history.go(-1);</script>";
     exit;
  }
  
  $serverrow = mysql_fetch_array(mysql_query("SELECT * FROM server WHERE id=".$sid));
  if($serverrow == false)
  {
     $serverrow = mysql_fetch_array(mysql_query("SELECT * FROM server ORDER BY id ASC LIMIT 1"));
  }
  
  $conn = mysql_connect($serverrow['mysqlip'], $serverrow['mysqlname'], $serverrow['mysqlpass']);
  if(!$conn)
  {
     echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
     echo "<script>alert('Kết nối cơ sở dữ liệu thất bại!');history.go(-1);</script>";
     exit;
  }
  mysql_select_db($serverrow['mysqlroledb'], $conn);
  mysql_query("SET NAMES 'utf8'", $conn);
  
  // Tim nhan vat (ho tro ca co tien to s0. hoac khong)
  $clean_role = str_replace(array('s0.', 's1.', 's2.'), '', $role_name);
  $playerinfo = mysql_fetch_array(mysql_query("SELECT * FROM user_role WHERE name='".mysql_real_escape_string($role_name)."' OR name='s0.".mysql_real_escape_string($role_name)."' OR name LIKE '%".mysql_real_escape_string($clean_role)."%' LIMIT 1", $conn));
  
  if(!$playerinfo)
  {
     echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
     echo "<script>alert('Không tìm thấy nhân vật [".$role_name."] trong hệ thống game!');history.go(-1);</script>";
     exit;
  }
  
  // Format attachment JSON hop le
  $attachments = "";
  if(!empty($mail_code))
  {
     if(substr($mail_code, 0, 1) == '[')
     {
        $attachments = $mail_code;
     }
     else
     {
        $attachments = '[{"attributes":"{}","bind":0,"expireTime":0,"expired":false,"goodsCount":'.$mail_count.',"goodsId":"'.addslashes($mail_code).'","itemLevel":1,"notice":false,"rareLevel":1,"slotNum":0}]';
     }
  }
  
  $b_time = time() . "000";
  $v_time = (time() + 86400 * 30) . "000";
  
  $id_res = mysql_fetch_array(mysql_query("SELECT MAX(CAST(id AS UNSIGNED)) FROM system_email", $conn));
  $b_id = ($id_res[0] ? intval($id_res[0]) : 0) + 1;
  
  $sql_sys = "INSERT INTO system_email (id, title, content, receiver_ids, jb, yb, create_time, valid_time, attachments) VALUES ('".$b_id."', '".mysql_real_escape_string($mail_name)."', '".mysql_real_escape_string($mail_content)."', '".$playerinfo['id']."', ".$mail_coin.", ".$mail_gold.", ".$b_time.", ".$v_time.", '".mysql_real_escape_string($attachments)."')";
  $res1 = mysql_query($sql_sys, $conn);
  
  // Neu co KNB hoac Tien, cap nhat luon vao so du nhan vat de co ngay lap tuc
  if($mail_gold > 0)
  {
     mysql_query("UPDATE user_account SET lingshi = lingshi + ".$mail_gold.", is_recharge = 1 WHERE user_guid = '".$playerinfo['user_id']."'", $conn);
  }
  if($mail_coin > 0)
  {
     mysql_query("UPDATE role_account SET tongqian = tongqian + ".$mail_coin." WHERE user_role_id = '".$playerinfo['id']."'", $conn);
  }

  // Gui truc tiep qua Java Game Server WebService (Port 8001) de phat song realtime trong game
  if(!empty($mail_code))
  {
     $ws_item = (substr($mail_code, 0, 1) == '[') ? "" : ($mail_code . ":" . ($mail_count > 0 ? $mail_count : 1) . ":0");
     if(!empty($ws_item))
     {
        $safe_title = htmlspecialchars(str_replace('&', ' và ', $mail_name));
        $safe_content = htmlspecialchars(str_replace('&', ' và ', $mail_content));
        $xml_post = '<?xml version="1.0" encoding="utf-8"?>'
                  . '<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns="http://goods.remoteservice.xianling.com/">'
                  . '  <soap:Body>'
                  . '    <ns:sendEquip>'
                  . '      <arg0>'.$playerinfo['id'].'</arg0>'
                  . '      <arg1>'.$ws_item.'</arg1>'
                  . '      <arg2>'.$safe_title.'</arg2>'
                  . '      <arg3>'.$safe_content.'</arg3>'
                  . '    </ns:sendEquip>'
                  . '  </soap:Body>'
                  . '</soap:Envelope>';
        $ch = curl_init("http://127.0.0.1:8001/SendEquip");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=utf-8'));
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_exec($ch);
        curl_close($ch);
     }
  }

  echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
  echo "<script>alert('Gửi quà thành công tới nhân vật [".$playerinfo['name']."]! Hãy kiểm tra hòm thư hoặc số dư trong game.');location.href='role_addarticle.php';</script>";
  exit;
}

if ($_POST[go]=="duihuan")
{
  ckdenglu();
  $moneytojifen=addslashes(trim($_POST['moneytojifen']));
  $moneytogold=addslashes(trim($_POST['moneytogold']));
  $jifentomoney=addslashes(trim($_POST['jifentomoney']));
  $jifentogold=addslashes(trim($_POST['jifentogold']));
  $goldtomoney=addslashes(trim($_POST['goldtomoney']));
  $goldtojifen=addslashes(trim($_POST['goldtojifen']));
  $tgtomoney=addslashes(trim($_POST['tgtomoney']));
  $tgtojifen=addslashes(trim($_POST['tgtojifen']));
  $tgtogold=addslashes(trim($_POST['tgtogold']));
  $moneytoggold=addslashes(trim($_POST['moneytoggold']));
  $jifentoggold=addslashes(trim($_POST['jifentoggold']));
  $goldtoggold=addslashes(trim($_POST['goldtoggold']));
  $tgtoggold=addslashes(trim($_POST['tgtoggold']));
  $moneytojifenroleChk=intval($_POST['moneytojifenroleChk']);
  $moneytogoldroleChk=intval($_POST['moneytogoldroleChk']);
  $jifentomoneyroleChk=intval($_POST['jifentomoneyroleChk']);
  $jifentogoldroleChk=intval($_POST['jifentogoldroleChk']);
  $goldtomoneyroleChk=intval($_POST['goldtomoneyroleChk']);
  $goldtojifenroleChk=intval($_POST['goldtojifenroleChk']);
  $tgtomoneyroleChk=intval($_POST['tgtomoneyroleChk']);
  $tgtojifenroleChk=intval($_POST['tgtojifenroleChk']);
  $tgtogoldroleChk=intval($_POST['tgtogoldroleChk']);
  $moneytoggoldroleChk=intval($_POST['moneytoggoldroleChk']);
  $jifentoggoldroleChk=intval($_POST['jifentoggoldroleChk']);
  $goldtoggoldroleChk=intval($_POST['goldtoggoldroleChk']);
  $tgtoggoldroleChk=intval($_POST['tgtoggoldroleChk']);
 
  mysql_query("update duihuan set bili='".$moneytojifen."',kaifang=".$moneytojifenroleChk." where duihuan='moneytojifen'");
  mysql_query("update duihuan set bili='".$moneytogold."',kaifang=".$moneytogoldroleChk." where duihuan='moneytogold'");
  mysql_query("update duihuan set bili='".$jifentomoney."',kaifang=".$jifentomoneyroleChk." where duihuan='jifentomoney'");
 mysql_query("update duihuan set bili='".$jifentogold."',kaifang=".$jifentogoldroleChk." where duihuan='jifentogold'");
 mysql_query("update duihuan set bili='".$goldtomoney."',kaifang=".$goldtomoneyroleChk." where duihuan='goldtomoney'");
 mysql_query("update duihuan set bili='".$goldtojifen."',kaifang=".$goldtojifenroleChk." where duihuan='goldtojifen'");
 mysql_query("update duihuan set bili='".$tgtomoney."',kaifang=".$tgtomoneyroleChk." where duihuan='tgtomoney'");
 mysql_query("update duihuan set bili='".$tgtojifen."',kaifang=".$tgtojifenroleChk." where duihuan='tgtojifen'");
 mysql_query("update duihuan set bili='".$tgtogold."',kaifang=".$tgtogoldroleChk." where duihuan='tgtogold'");
 mysql_query("update duihuan set bili='".$moneytoggold."',kaifang=".$moneytoggoldroleChk." where duihuan='moneytoggold'");
 mysql_query("update duihuan set bili='".$jifentoggold."',kaifang=".$jifentoggoldroleChk." where duihuan='jifentoggold'");
 mysql_query("update duihuan set bili='".$goldtoggold."',kaifang=".$goldtoggoldroleChk." where duihuan='goldtoggold'");
 mysql_query("update duihuan set bili='".$tgtoggold."',kaifang=".$tgtoggoldroleChk." where duihuan='tgtoggold'");
   echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
   echo "<script>alert('修改完成！');location.href='duihuan.php'</script>";
   exit;
}
if ($_POST[go]=="sys")
{
  ckdenglu();
  $webname=$_POST['webname'];
  $webdomain=$_POST['webdomain'];
  $tem="<?php
\$webname=\"".$webname."\";
\$webdomain=\"".$webdomain."\";
?>";
file_put_contents("../sysconfig.php",$tem);
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
echo "<script>alert('修改完成！');location.href='sys.php'</script>";
exit;
}

?>