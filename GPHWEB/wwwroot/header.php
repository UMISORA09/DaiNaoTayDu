<div class="header">
    <div class="top_content clearfix">
        <ul class="usered">
<?php
        if ($GLOBALS["gcook"]==0)
{
?>
            <li class="lines"></li>
            <li><a href="reg.php">Đăng Ký</a> </li>
            <li class="lines"></li>
            <li><a href="login.php">Đăng Nhập</a> </li>
            <li class="lines"></li>
<?php
}else
{
?>
            <li><a href="Action.php?go=logout">Thoát</a> </li>
            <li class="lines"></li>
            <li><a href="tuiguang.php">Quảng Bá</a> </li>
            <li class="lines"></li>
            <li><a href="user_index.php" class="red"><?=$GLOBALS["gname"];?></a> </li>
            <li>Tài khoản: </li>
<?php
}
?>
        </ul>
        <div class="lz">
            <a href="<?=$webdomain;?>"><?=$webname;?></a> <span>| </span><a>Server Game Offline</a>
        </div>
    </div>
</div>
<div class="top">
    <div class="top_logo">
        <div class="top_logo_con clearfix">
        </div>
    </div>
    <div class="nav">
        <ul class="clearfix">
            <li <?php if ($thispage==1) echo "class=\"select\""; ?> ><a href="index.php">Trang Chủ</a></li>
            <li <?php if ($thispage==2) echo "class=\"select\""; ?> ><a href="user_index.php">Quản Lý Tài Khoản</a></li>
            <li <?php if ($thispage==3) echo "class=\"select\""; ?> ><a href="tuiguang.php">Quảng Bá</a></li>
            <li <?php if ($thispage==4) echo "class=\"select\""; ?> ><a href="duihuan.php">Đổi KNB</a></li>
            <li <?php if ($thispage==6) echo "class=\"select\""; ?> ><a target="_blank" href="Pay.php">Nạp Tiền</a></li>
            <li class="orange"><a href="login.php">Đăng Nhập</a><em></em></li>
            <li class="orange"><a href="reg.php">Đăng Ký</a><em></em></li>
        </ul>
    </div>
</div>