<?php
include 'getfunction.php';
ckdenglu();
include "../config.php";

$serverinfo = mysql_query("SELECT * FROM server");
$num = mysql_num_rows($serverinfo);

// Lay danh sach nhan vat gan nhat trong dntg
$role_options = array();
$serverrow_temp = mysql_fetch_array(mysql_query("SELECT * FROM server ORDER BY id ASC LIMIT 1"));
if($serverrow_temp)
{
    $conn_temp = mysql_connect($serverrow_temp['mysqlip'], $serverrow_temp['mysqlname'], $serverrow_temp['mysqlpass']);
    if($conn_temp)
    {
        mysql_select_db($serverrow_temp['mysqlroledb'], $conn_temp);
        mysql_query("SET NAMES 'utf8'", $conn_temp);
        $roles_q = mysql_query("SELECT name, level FROM user_role ORDER BY id DESC LIMIT 20", $conn_temp);
        if($roles_q)
        {
            while($r = mysql_fetch_array($roles_q))
            {
                $role_options[] = $r;
            }
        }
        mysql_close($conn_temp);
    }
}
include "../config.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GM Gửi Đồ & KNB</title>
<style type="text/css">
body { font-family: Tahoma, Arial, sans-serif; font-size: 13px; color: #333; margin: 15px; }
table { border-collapse: collapse; width: 100%; max-width: 900px; margin: 0 auto; background: #fff; box-shadow: 0 1px 4px rgba(0,0,0,0.1); border-radius: 6px; overflow: hidden; }
td { padding: 10px 14px; border-bottom: 1px solid #eee; }
.tit_bg { background: #2c3e50; color: #fff; font-size: 16px; padding: 12px; font-weight: bold; }
.label_col { width: 22%; text-align: right; font-weight: bold; background: #f9fbfd; color: #444; }
.inputclass { padding: 8px 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 13px; box-sizing: border-box; }
.inputclass:focus { border-color: #3498db; outline: none; }
.btn_submit { background: #27ae60; color: #fff; border: none; padding: 10px 30px; font-size: 15px; font-weight: bold; border-radius: 4px; cursor: pointer; transition: 0.2s; }
.btn_submit:hover { background: #219150; }
.hint { color: #888; font-size: 12px; margin-left: 8px; }
.item_quick_list { margin-top: 10px; font-size: 12px; color: #555; background: #f4f6f9; padding: 8px 12px; border-radius: 4px; border-left: 3px solid #3498db; }
.item_quick_list a { color: #2980b9; text-decoration: none; margin-right: 12px; font-weight: bold; }
.item_quick_list a:hover { text-decoration: underline; }
</style>
<script type="text/javascript">
function setRole(name) {
    document.getElementById("role_name").value = name;
}
function setItem(id, count) {
    document.getElementById("mail_code").value = id;
    document.getElementById("mail_count").value = count;
}
</script>
</head>
<body>

<form action="Action.php" method="post" name="Form1">
<table>
  <tr>
    <td colspan="2" align="center" class="tit_bg">QUẢN LÝ GM: GỬI KNB, TIỀN ĐỒNG & VẬT PHẨM</td>
  </tr>
  
  <tr>
    <td class="label_col">Máy chủ (Server):</td>
    <td>
      <select name="sid" class="inputclass" style="width: 220px;">
        <?php 
        $serverinfo = mysql_query("SELECT * FROM server");
        while($row = mysql_fetch_array($serverinfo)) {
            echo "<option value='".$row['id']."'>".$row['servername']." (ID: ".$row['id'].")</option>";
        }
        ?>
      </select>
    </td>
  </tr>
  
  <tr>
    <td class="label_col">Tên nhân vật nhận:</td>
    <td>
      <input name="role_name" type="text" id="role_name" size="25" class="inputclass" value="<?php echo !empty($role_options[0]['name']) ? $role_options[0]['name'] : ''; ?>" required />
      <span class="hint">Ví dụ: <b>Ahien06</b> hoặc <b>s0.Ahien06</b></span>
      <?php if(!empty($role_options)): ?>
      <div style="margin-top: 6px; font-size: 12px;">
        Nhân vật có sẵn: 
        <?php foreach($role_options as $ro): ?>
          <a href="javascript:void(0)" onclick="setRole('<?=$ro['name'];?>')" style="color:#2980b9; margin-right:8px; font-weight:bold;">[<?=$ro['name'];?> (Lv.<?=$ro['level'];?>)]</a>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </td>
  </tr>
  
  <tr>
    <td class="label_col">Tiêu đề thư:</td>
    <td>
      <input name="mail_name" type="text" size="40" class="inputclass" value="Quà Tặng Từ GM" />
    </td>
  </tr>
  
  <tr>
    <td class="label_col">Nội dung thư:</td>
    <td>
      <input name="mail_content" type="text" size="60" class="inputclass" value="Chúc bạn chơi game Đại Náo Thiên Cung vui vẻ!" />
    </td>
  </tr>  
  
  <tr>
    <td class="label_col">KNB (Nguyên Bảo):</td>
    <td>
      <input name="mail_gold" type="number" size="15" class="inputclass" value="100000" />
      <span class="hint">Số KNB gửi vào hòm thư nhân vật (Ví dụ: 100,000)</span>
    </td>
  </tr>
  
  <tr>
    <td class="label_col">Tiền Đồng:</td>
    <td>
      <input name="mail_coin" type="number" size="15" class="inputclass" value="10000000" />
      <span class="hint">Số tiền đồng gửi vào hòm thư (Ví dụ: 10,000,000)</span>
    </td>
  </tr>
  
  <tr>
    <td class="label_col">Mã Vật Phẩm (ID):</td>
    <td>
      <input name="mail_code" id="mail_code" type="text" size="30" class="inputclass" value="" placeholder="Ví dụ: w10005" />
      &nbsp;&nbsp;Số lượng: 
      <input name="mail_count" id="mail_count" type="number" size="5" class="inputclass" style="width: 70px;" value="1" min="1" />
      <span class="hint">Để trống nếu chỉ muốn gửi KNB / Đồng</span>
      
      <div class="item_quick_list">
        <b>Gợi ý một số vật phẩm hot (Bấm để chọn):</b><br/>
        <a href="javascript:void(0)" onclick="setItem('w10005', 1)">[Phi Phong Tân Thủ: w10005]</a>
        <a href="javascript:void(0)" onclick="setItem('w10021', 1)">[Ngũ Cực Thiên Bảo Phi Phong: w10021]</a>
        <a href="javascript:void(0)" onclick="setItem('w10045', 1)">[Tinh Diễn Xích Tiêu Phi Phong: w10045]</a>
        <a href="javascript:void(0)" onclick="setItem('sz0001', 1)">[Pháp Trượng Nguyên Thủy: sz0001]</a>
        <a href="javascript:void(0)" onclick="setItem('zj0410', 1)">[Hộ Thoái Lv.40: zj0410]</a>
        <a href="javascript:void(0)" onclick="setItem('silver1000', 10)">[1000 Lễ Kim x10: silver1000]</a>
        <a href="javascript:void(0)" onclick="setItem('prestige003', 10)">[Danh Vọng Đan Lớn x10: prestige003]</a>
      </div>
    </td>
  </tr>
  
  <tr>
    <td colspan="2" align="center" style="padding: 16px;">
      <input type="hidden" value="add_mail" name="go" />
      <input type="submit" class="btn_submit" value="XÁC NHẬN GỬI QUÀ" />
    </td>
  </tr>
</table>
</form>

</body>
</html>