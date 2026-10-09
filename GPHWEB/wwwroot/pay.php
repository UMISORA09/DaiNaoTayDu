<?php
include 'getfunction.php';
include 'sysconfig.php';
ckcookie();

if($GLOBALS["gcook"]==0)
{
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
    echo "<script>alert('Vui lòng đăng nhập trước khi rút KNB!');location.href='login.php';</script>";
    exit;
}

$conn = mysql_connect($mysql_server, $mysql_user, $mysql_pwd);
mysql_select_db($mysql_db, $conn);
mysql_query("SET NAMES 'utf8'");

$username = $GLOBALS["gname"];
$namemd5id = $GLOBALS["gnamemd5id"];

// Get character info
$find_role = mysql_query("SELECT roleid, serverid FROM roleid WHERE namemd5id='".$namemd5id."' ORDER BY id ASC LIMIT 1");
$role_row = mysql_fetch_array($find_role);
$roleid = $role_row ? $role_row['roleid'] : '';

// Get user account balance
$acc_info = mysql_fetch_array(mysql_query("SELECT * FROM account WHERE name='".$username."'"));

// Connect to game DB dntg
$game_db_conn = mysql_connect("127.0.0.1", "root", "123456");
mysql_select_db("dntg", $game_db_conn);
mysql_query("SET NAMES 'utf8'");

$msg = "";
if(isset($_POST['action']) && $_POST['action'] == 'withdraw_knb')
{
    $amount = isset($_POST['amount']) ? intval($_POST['amount']) : 0;
    if($amount <= 0)
    {
        $msg = "<div class='alert error'>Vui lòng nhập số KNB hợp lệ (lớn hơn 0)!</div>";
    }
    else
    {
        // Safe cap to prevent 32-bit int overflow
        $cur_knb_row = mysql_fetch_array(mysql_query("SELECT lingshi FROM user_account WHERE user_guid='".$roleid."'"));
        $cur_knb = $cur_knb_row ? intval($cur_knb_row['lingshi']) : 0;
        
        if($cur_knb + $amount > 1000000000)
        {
            $amount = 1000000000 - $cur_knb;
        }
        
        if($amount > 0)
        {
            mysql_query("UPDATE user_account SET lingshi = lingshi + ".$amount.", is_recharge = 1, log_update_time = NOW() WHERE user_guid='".$roleid."'");
            $msg = "<div class='alert success'>🎉 Đã rút thành công ".number_format($amount)." KNB vào nhân vật! Hãy kiểm tra trong game.</div>";
        }
        else
        {
            $msg = "<div class='alert error'>Nhân vật của bạn đã đạt giới hạn tối đa KNB (1 Tỷ KNB)!</div>";
        }
    }
}

// Get updated in-game KNB
$game_acc = mysql_fetch_array(mysql_query("SELECT lingshi FROM user_account WHERE user_guid='".$roleid."'"));
$in_game_knb = $game_acc ? intval($game_acc['lingshi']) : 0;

$role_info = mysql_fetch_array(mysql_query("SELECT name, level FROM user_role WHERE user_id='".$roleid."'"));
$role_name = $role_info ? $role_info['name'] : 'Chưa tạo nhân vật';
$role_lvl = $role_info ? $role_info['level'] : 0;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nạp & Rút KNB - Đại Náo Thiên Cung</title>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        background: radial-gradient(circle at center, #1e2638 0%, #0d1117 100%);
        color: #e6edf3;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .card {
        background: rgba(22, 27, 34, 0.85);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 215, 0, 0.3);
        border-radius: 16px;
        box-shadow: 0 16px 36px rgba(0, 0, 0, 0.6), 0 0 20px rgba(255, 215, 0, 0.15);
        width: 100%;
        max-width: 500px;
        padding: 32px;
        box-sizing: border-box;
    }
    h2 {
        margin-top: 0;
        text-align: center;
        color: #ffd700;
        text-shadow: 0 0 10px rgba(255, 215, 0, 0.4);
        font-size: 26px;
    }
    .info-box {
        background: rgba(13, 17, 23, 0.8);
        border: 1px solid #30363d;
        border-radius: 10px;
        padding: 16px;
        margin-bottom: 24px;
    }
    .info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 15px;
    }
    .info-row:last-child {
        margin-bottom: 0;
    }
    .highlight {
        color: #ffd700;
        font-weight: bold;
    }
    .btn-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-bottom: 20px;
    }
    .quick-btn {
        background: linear-gradient(135deg, #238636 0%, #2ea043 100%);
        color: #fff;
        border: none;
        padding: 12px;
        border-radius: 8px;
        font-weight: bold;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .quick-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(46, 160, 67, 0.4);
    }
    .custom-group {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }
    .custom-input {
        flex: 1;
        background: #0d1117;
        border: 1px solid #30363d;
        border-radius: 8px;
        color: #fff;
        padding: 12px 16px;
        font-size: 16px;
        box-sizing: border-box;
    }
    .submit-btn {
        background: linear-gradient(135deg, #d29922 0%, #f0883e 100%);
        color: #fff;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: bold;
        font-size: 16px;
        cursor: pointer;
        width: 100%;
        transition: all 0.2s ease;
    }
    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(240, 136, 62, 0.5);
    }
    .alert {
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
        text-align: center;
    }
    .alert.success {
        background: rgba(46, 160, 67, 0.2);
        border: 1px solid #2ea043;
        color: #3fb950;
    }
    .alert.error {
        background: rgba(248, 81, 73, 0.2);
        border: 1px solid #f85149;
        color: #ff7b72;
    }
    .back-link {
        display: block;
        text-align: center;
        margin-top: 18px;
        color: #58a6ff;
        text-decoration: none;
        font-size: 14px;
    }
    .back-link:hover {
        text-decoration: underline;
    }
</style>
<script>
function setAmount(val) {
    document.getElementById('amountInput').value = val;
}
</script>
</head>
<body>

<div class="card">
    <h2>💎 RÚT KNB VÀO GAME</h2>
    
    <?=$msg;?>

    <div class="info-box">
        <div class="info-row">
            <span>Tài khoản:</span>
            <span class="highlight"><?=$username;?></span>
        </div>
        <div class="info-row">
            <span>Nhân vật:</span>
            <span class="highlight"><?=$role_name;?> (Cấp <?=$role_lvl;?>)</span>
        </div>
        <div class="info-row">
            <span>KNB hiện có trong game:</span>
            <span class="highlight"><?=number_format($in_game_knb);?> KNB</span>
        </div>
    </div>

    <div class="btn-grid">
        <button type="button" class="quick-btn" onclick="setAmount(50000)">+ 50.000 KNB</button>
        <button type="button" class="quick-btn" onclick="setAmount(100000)">+ 100.000 KNB</button>
        <button type="button" class="quick-btn" onclick="setAmount(500000)">+ 500.000 KNB</button>
        <button type="button" class="quick-btn" onclick="setAmount(1000000)">+ 1.000.000 KNB</button>
    </div>

    <form method="POST">
        <input type="hidden" name="action" value="withdraw_knb">
        <div class="custom-group">
            <input type="number" id="amountInput" name="amount" class="custom-input" placeholder="Nhập số lượng KNB muốn rút..." required min="1" max="100000000" value="100000">
        </div>
        <button type="submit" class="submit-btn">⚡ XÁC NHẬN RÚT KNB VÀO NHÂN VẬT</button>
    </form>

    <a href="game.php" class="back-link">← Quay lại trang trò chơi</a>
</div>

</body>
</html>
