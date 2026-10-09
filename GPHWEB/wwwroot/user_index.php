<?php
include 'getfunction.php';
ckcookie();
$thispage=2;
if($GLOBALS["gcook"]==0)
{
      echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
	  echo "<script>location.href='login.php'</script>";
	  exit;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1"><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员中心-</title>
<link href="css/BasicStyle.css" type="text/css" rel="stylesheet" />
<link href="css/jquery-ui.min.css" type="text/css" rel="stylesheet" />
<link href="css/jmodal.css" type="text/css" rel="stylesheet" />
<link href="css/loading.css" type="text/css" rel="stylesheet" />
<script src="js/jquery.min.js" type="text/javascript" charset="UTF-8"></script>
<script src="js/jquery-ui.min.js" type="text/javascript" charset="UTF-8"></script>
<script src="js/jmodal.js" type="text/javascript" charset="UTF-8"></script>
<script src="js/loading.js" type="text/javascript" charset="UTF-8"></script>
<script src="js/Common.js" type="text/javascript" charset="UTF-8"></script>
<script src="js/Extends.js" type="text/javascript" charset="UTF-8"></script>
<script src="js/AjaxRequest.js" type="text/javascript" charset="UTF-8"></script></head>

<body id="loadding">

<?php
	require "header.php";
?>

    <div class="center clearfix mt10">

        <div class="c_main">


<?php
	require "user_left.php";
?>



<div class="center_right ml10">

    <!--无邮箱提示开始 检测到无邮箱才显示-->

    

    <div class="loveyTip clearfix mb10">

        <span class="loveytip_close fr" title="关闭" onClick="this.parentNode.style.display='none'"></span><span class="fl"><span class="cBlack">Lưu ý quan trọng: </span>Mỗi cụm máy chủ chỉ nên tạo một nhân vật chính để tránh lỗi dữ liệu.<a>玩家自行负责</a> </span>

    </div>

    

    <!--无邮箱提示结束-->

    <div class="basicInfo">

        <div class="basicInfo_content">

            <p>

                Tài khoản: <b class="orange"><?=$GLOBALS["gname"];?></b><b class="segmentation"></b> Ngày đăng ký: <b

                    class="orange"><?=$GLOBALS["gcreatetime"];?></b><b class="segmentation"></b>IP: <b

                    class="orange"><?=$GLOBALS["gregip"];?></b></p>
            <p>
            </p>
            <p>

                Quảng bá: Hiện có <b class="orange"><?=$GLOBALS["gtg"];?></b> lượt <b class="segmentation"></b>Tổng cộng <b

                    class="orange"><?=$GLOBALS["gtg2"];?></b>推广<b class="segmentation"></b>Đổi được <b class="orange">0</b> KNB <b class="orange">0</b> Điểm nạp

                

            </p>

            <p>

                <a href="game.php" target="_blank" class="bt_but c_1_g mr10 tips"><u></u>Vào Game</a>
                <a  href="duihuan.php"   class="bt_but c_1_g mr10 tips"><u></u>Đổi Thưởng</a>
				<a  href="weiduan.rar"   class="bt_but c_1_g mr10 tips"><u></u>Tải Client Mini</a>
                <a  href="Action.php?go=logout"   class="bt_but c_1_g mr10 tips"><u></u>Đăng Xuất</a>

            </p>

        </div>

        <div class="basicInfo_currency">

            <ul class="clearfix">

                <li><span class="orange"><?php echo Getshoptype("money");?>：</span> <span>

                    <?=$GLOBALS["gmoney"];?></span> </li>

                <li><span class="orange" title="充值多少元宝就返还多少的 Điểm nạp"><?php echo Getshoptype("jifen");?>：</span> <span>

                    <?=$GLOBALS["gjifen"];?></span> </li>
				 <li><span class="orange" title="充值多少元宝就返还多少的 Điểm nạp"><?php echo Getshoptype("gold");?>：</span> <span>

                    <?=$GLOBALS["ggold"];?></span> </li>	

            </ul>

        </div>

    </div>

    <div class="basicInfor-content-shadow">

    </div>

    <div class="mybox">


        <div class="mytit">

            Thông Tin Nhân Vật [<b class="orange">Dữ liệu nhân vật đồng bộ từ máy chủ</b>]

        </div>
        <div class="myinfo_con clearfix">
		
			<p><?php echo GetRoleList();?></p>
			<p>&nbsp;    </p>
        </div>

    </div>


</div>

</div></div>
<?php
	require "footer.php";
?>

</body>

</html>

