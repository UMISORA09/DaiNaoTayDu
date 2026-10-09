

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
  include_once "../configuration/config.inc.php";
  if(!$_SESSION['accountName']) exit("<script> alert('请登陆后使用！');location.href='../UserCenter/Login.php';</script>");
?> 
<title>
	
        <?php echo $WebTitle; ?>-推广中心
</title>
<link href="../ClientRes/Styles/BasicStyle.css?_v=634979371913162195" type="text/css" rel="stylesheet" />
<link href="../ClientRes/Styles/jquery-ui.min.css?_v=634979244165085356" type="text/css" rel="stylesheet" />
<link href="../ClientRes/Styles/jmodal.css?_v=634979244164935253" type="text/css" rel="stylesheet" />
<link href="../ClientRes/Styles/loading.css?_v=634979244165185438" type="text/css" rel="stylesheet" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript" charset="UTF-8"></script>
 <!--如果google CDN不正常，就从本地获取JQ库。--> 
<script>!window.jQuery && document.write('<script src="/ClientRes/Scripts/jquery.min.js"><\/script>');</script>
<script src="../ClientRes/Scripts/jquery-ui.min.js?_v=634979244162663753" type="text/javascript" charset="UTF-8"></script>
<script src="../ClientRes/Scripts/jmodal.js?_v=634979244161903250" type="text/javascript" charset="UTF-8"></script>
<script src="../ClientRes/Scripts/loading.js?_v=634979244164224791" type="text/javascript" charset="UTF-8"></script>
<script src="../ClientRes/Scripts/Common.js?_v=634979706622125062" type="text/javascript" charset="UTF-8"></script>
<script src="../ClientRes/Scripts/Extends.js?_v=634979244161412905" type="text/javascript" charset="UTF-8"></script>
<script src="../ClientRes/Scripts/AjaxRequest.js?_v=634979244161282816" type="text/javascript" charset="UTF-8"></script></head>
<?php 
require '../TempLate/PublicTop.html';//引用模板 
?> 
    <div class="center clearfix mt10">
        <div class="c_main">
<?php 
require '../TempLate/LeftNav.html';//引用模板 

  	$sql="SELECT b.lid FROM $database.account a,$database.spread b,$database2.`user` c,$database2.player d WHERE b.tid='".$_SESSION['accountName']."' and b.lid=a.`name` AND a.`name`=c.loginName and c.id=d.userId AND d.grade>=".$lv." and b.islq=1";
	$result=mysql_query($sql);
	$total1x=$total1*$tgyuanbao;
	$tg= $weburl.'UserCenter/Register.php?Sid='.passport_encrypt($_SESSION['accountName'],"nimabi");
?> 
<div class="center_right ml10">
    <div class="mybox">
        <div class="mytit">
            我要推广
        </div>
        <div class="con clearfix">
            <p>
                账号：<b class="orange"><?php echo $_SESSION['accountName'];?></b>
                <b class="segmentation"></b>
                已获得推广元宝：<b class="orange"><?php echo $total1x;?></b>
                <b class="segmentation"></b>
                <a href="/UserCenter/"    class="bt_but c_1_g mr10 tips"><u></u>返回会员中心</a>
            </p>
			<br>
            <div class="spreadWord" style="width: 763px; height: 150px;">
			
  <textarea name="AD" rows="6" cols="148" style="font-weight: bold; background-color: #FFFAE5; color: #FF5A00; border: 1px #CCB59F solid; width: 778px; height: 100px; font-size: 12px;">
【<?php echo $WebTitle;?>】2014最新变身战斗页游(大闹天宫） 人气暴满 刚开一秒
★独家服务器带宽，电信网通用户都不卡！
★上线送99999999铜钱（会员中心领取）
★上线9999999绑定元宝（会员中心领取）
★上线免费领取VIP10，VIP1-10全部礼包都能领取！
★无限筋斗云，酷眩骑战兵器，特效副本，大量宝石精华，坐骑特效等！（会员中心领取）
★开放网页商城，N多免费商品敬请选择！
真实不掺水，专业不坑爹！
稳定运营长久玩家的选择！
注册地址：<?php echo $tg;?>   
</textarea><br>
<center><input  style="width:480px;height:22px;color:#F30000;font-size:12px;"  type="button" value="点击复制推广内容——非IE浏览器请手动复制以上内容" name="COPY" onClick=window.clipboardData.setData('Text',document.all.AD.value); /></center>		
<br>
			
                
            </div>
        </div>
    </div>
</div>
<?php 
require '../TempLate/PublicButtom.html';//引用模板 
?> 
</html>
