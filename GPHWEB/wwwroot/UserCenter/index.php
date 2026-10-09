<?php 
ini_set("error_reporting","E_ALL & ~E_NOTICE");
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
  include_once "../configuration/config.inc.php";
   if(!$_SESSION['accountName']) exit("<script>location.href='Login.php';</script>");
?>
<title>	
        <?php echo $WebTitle; ?>-会员中心
</title>
<link href="/ClientRes/Styles/BasicStyle.css?_v=634979371913162195" type="text/css" rel="stylesheet" />
<link href="/ClientRes/Styles/jquery-ui.min.css?_v=634979244165085356" type="text/css" rel="stylesheet" />
<link href="/ClientRes/Styles/jmodal.css?_v=634979244164935253" type="text/css" rel="stylesheet" />
<link href="/ClientRes/Styles/loading.css?_v=634979244165185438" type="text/css" rel="stylesheet" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript" charset="UTF-8"></script>
 <!--如果google CDN不正常，就从本地获取JQ库。--> 
<script>!window.jQuery && document.write('<script src="/ClientRes/Scripts/jquery.min.js"><\/script>');</script>
<script src="/ClientRes/Scripts/jquery-ui.min.js?_v=634979244162663753" type="text/javascript" charset="UTF-8"></script>
<script src="/ClientRes/Scripts/jmodal.js?_v=634979244161903250" type="text/javascript" charset="UTF-8"></script>
<script src="/ClientRes/Scripts/loading.js?_v=634979244164224791" type="text/javascript" charset="UTF-8"></script>
<script src="/ClientRes/Scripts/Common.js?_v=634979706622125062" type="text/javascript" charset="UTF-8"></script>
<script src="/ClientRes/Scripts/Extends.js?_v=634979244161412905" type="text/javascript" charset="UTF-8"></script>
<script src="/ClientRes/Scripts/AjaxRequest.js?_v=634979244161282816" type="text/javascript" charset="UTF-8"></script></head>

<?php 
require '../TempLate/PublicTop.html';//引用模板 
?> 
    <div class="center clearfix mt10">
        <div class="c_main">
<?php 
require '../TempLate/LeftNav.html';//引用模板
	$username=$_SESSION['accountName'];
	$sql= "SELECT * FROM dntg.user_role WHERE user_id = '".$username."'";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	
	
	$sql= "SELECT * FROM web.account WHERE `name` ='".$username."'";
	$result=mysql_query($sql);
	$row2=mysql_fetch_array($result);
	
	
	$sql= "SELECT * FROM dntg.user_account WHERE `user_guid` ='".$username."'";
	$result=mysql_query($sql);
	$row3=mysql_fetch_array($result);
	
	//var_dump($row3);
	$total=mysql_num_rows($result);
	$dhyb=$total*$tgyuanbao;
	$timestamp = time();
	
	
	
	    $sqlz = "SELECT b.lid FROM $database.account a,$database.spread b,$database2.`user_account` c,$database2.user_role d WHERE b.tid='" . $_SESSION['accountName'] . "' and b.lid=a.`name` AND a.`name`=c.user_guid and c.user_guid=d.user_id AND d.level>=" . $lv . " and b.islq=0";
		$result22 = mysql_query($sqlz);

	
?> 
<div class="center_right ml10">
    <!--无邮箱提示开始 检测到无邮箱才显示-->
    
    <!--无邮箱提示结束-->


    <div class="basicInfo">
        <div class="basicInfo_content">
            <p>
                账号：<b class="orange"><?php echo $username;?></b></b>
            </p>
           
            <p>
                推广信息：当前<b class="orange"><?php echo mysql_num_rows($result22);?></b>个达到<b class="orange"><?php echo $lv;?></b>级的推广<b class="segmentation"></b>可兑换<b class="orange"><?php echo $dhyb;?></b>个元宝<b class="segmentation"></b>每个推广兑换<b class="orange"><?php echo $tgyuanbao;?>元宝</b>
                
            </p>
            <p>
                <a href="/Gamelogin.php"  class="bt_but c_1_g mr10 tips" target=_blank><u></u>进入游戏(IE浏览器)</a>
				<a href="/Gamelogin360.php"  class="bt_but c_1_g mr10 tips" target=_blank><u></u>进入游戏(其它浏览器)</a>
				<a  onclick="SignOut();"   class="bt_but c_1_g mr10 tips"><u></u>注销登录</a></a>
            </p>

        </div>

        <div class="basicInfo_currency">
            <ul class="clearfix">
                <li><span class="orange">还未领取元宝：</span> <span>
                    <?php echo $row2['dj'];?></span> </li>
				<li><span class="orange">当前积分：</span> <span>
				<?php echo $row2['jf'];?></span> </li>

<li><a>提示：在角色信息处领取</a></li>
					
            </ul>
        </div>
    </div>
    <div class="basicInfor-content-shadow">
    </div>
    <div class="mybox">
        <script type="text/javascript">
            $(function () {
                $.ajaxSetup({ cache: false });
                $("#tabs").tabs();
            })
        </script>
  <div class="mytit">
            角色信息[<b class="orange">请先创建角色，角色数据以游戏内为准</b>]
        </div>
        <div class="myinfo_con clearfix">
          <script type="text/javascript">
                $(function () {
                    <?php 
						if(!$row || !is_array($row)){
							echo '$'.'("#tabs").html("<strong>您还没有创建角色，创建角色后可在此处领取推广元宝</strong>")';
						}
					?>
                })
            </script>
<div id="tabs" class="ui_tabs">
                <ul>
                    <li><a href="#tabs-1"><?php echo $row['name'];?></a></li>
                </ul>
                <div id="tabs-1">	<p>
            角色名字：<b class="orange"><?php echo $row['name'];?></b>&nbsp;|&nbsp;角色等级：<b class="orange"><?php echo $row['level'];?></b>&nbsp;|&nbsp;角色经验：<b class="orange"><?php echo $row['exp'];?></b>&nbsp;</b>&nbsp;|&nbsp;当前元宝：<b class="orange"><?php echo $row3['lingshi'];?></b>
	</p>
元宝领取：<a  href="/coon/de.php"   class="bt_but c_1_g mr10 tips"><u></u>点击领取充值元宝</a>
推广领取：<a  onclick="SpreadTran()"   class="bt_but c_1_g mr10 tips"><u></u>点击领取推广元宝</a></br>
上线就送：<a  href="/sxjl.php"   class="bt_but c_1_g mr10 tips"><u></u>点击领取99999999铜钱，9999999绑定元宝</a></br>
免费VIP10：<a  href="/vip.php"   class="bt_but c_1_g mr10 tips"><u></u>点击领取免费VIP10</a></br>
免费领取金身：<a  href="/js.php"   class="bt_but c_1_g mr10 tips"><u></u>75级领取9级金身</a></br>
免费领取光翼：<a  href="/gy.php"   class="bt_but c_1_g mr10 tips"><u></u>65级领取1级光翼</a></br>
累计充值奖励：<a  href="/ljcz.php"   class="bt_but c_1_g mr10 tips"><u></u>点击领取无限元宝无限积分奖励</a></br>
测试专用元宝：<a  href="/yuanbao.php"   class="bt_but c_1_g mr10 tips"><u></u>点击领取1亿非绑定元宝</a></br>
        </div>
		[<b class="orange">以上领取功能，游戏必须下线在领取，否则领取不到，领取完了在上线！</b>]
    </div>
</div></div>
<div class="basicInfor-content-shadow">
    </div>


</div>
</div></div>
<?php 
require '../TempLate/PublicButtom.html';//引用模板 
?> 
</html>
