import pymysql
import json
import time

conn = pymysql.connect(host='127.0.0.1', port=3306, user='root', password='123456', charset='utf8')
cursor = conn.cursor()

# 1. Dọn dẹp role_email bị lỗi của fu0UR1-15-0-1 và các role khác nếu có
bad_role_emails = ['fu0EM1-16-0-2', 'fu0EM1-19-0-3', 'fu0EM1-26-sj-mail', 'fu0EM1-32-0-4']
for eid in bad_role_emails:
    cursor.execute("DELETE FROM dntg.role_email WHERE id=%s", (eid,))
print(f"Deleted {cursor.rowcount} bad role_emails")

# 2. Dọn dẹp system_email bị lỗi cú pháp JSON hoặc item không tồn tại
bad_sys_emails = [2, 9, 12, 14, 18, 30]
for sid in bad_sys_emails:
    cursor.execute("DELETE FROM dntg.system_email WHERE id=%s", (sid,))
print(f"Deleted {cursor.rowcount} bad system_emails")

# 3. Sửa bảng libao_list trong dnweb: sửa lỗi cú pháp JSON dính liền
cursor.execute("SELECT id, libao_code FROM dnweb.libao_list")
rows = cursor.fetchall()
for lid, lcode in rows:
    if lcode and '}{' in lcode:
        fixed_code = lcode.replace('}{', '},{')
        cursor.execute("UPDATE dnweb.libao_list SET libao_code=%s WHERE id=%s", (fixed_code, lid))
        print(f"Fixed dnweb.libao_list id={lid}")

# 4. Reset gift_code và gift_5code của user fu0UR1-15-0-1
cursor.execute("DELETE FROM dntg.gift_code WHERE user_role_id='fu0UR1-15-0-1'")
cursor.execute("DELETE FROM dntg.gift_5code WHERE user_role_id='fu0UR1-15-0-1'")
print("Reset gift_code and gift_5code for user fu0UR1-15-0-1")

# 5. Tạo một email quà tặng mới cực xịn, hợp lệ 100%
now_ms = int(time.time() * 1000)
new_mail_id = f"fu0EM1-VIP-{int(time.time())}"

# Tạo 6 món quà cực chuẩn:
# 1. exppill_005 (Siêu Cấp Kinh Nghiệm Đan x 999)
# 2. 120jianding1 (120 Cấp + 5 Trang Bị Rương x 20)
# 3. tz0901 (Thánh Vương Bùa Hộ Mệnh Phải x 1)
# 4. tz0902 (Thánh Vương Bùa Hộ Mệnh Trái x 1)
# 5. sz0001 (Thiên Nguyên Pháp Trượng x 1)
# 6. baoshihuodong4 (Bảo Thạch Đặc Biệt Ưu Đãi Xa Hoa Lễ Bao x 50)
gift_items = [
    {"attributes": "{}", "bind": 0, "expireTime": 0, "expired": False, "goodsCount": 999, "goodsId": "exppill_005", "itemLevel": 1, "notice": False, "rareLevel": 4, "slotNum": 0},
    {"attributes": "{}", "bind": 0, "expireTime": 0, "expired": False, "goodsCount": 20, "goodsId": "120jianding1", "itemLevel": 1, "notice": False, "rareLevel": 4, "slotNum": 1},
    {"attributes": "{}", "bind": 0, "expireTime": 0, "expired": False, "goodsCount": 1, "goodsId": "tz0901", "itemLevel": 1, "notice": False, "rareLevel": 5, "slotNum": 2},
    {"attributes": "{}", "bind": 0, "expireTime": 0, "expired": False, "goodsCount": 1, "goodsId": "tz0902", "itemLevel": 1, "notice": False, "rareLevel": 5, "slotNum": 3},
    {"attributes": "{}", "bind": 0, "expireTime": 0, "expired": False, "goodsCount": 1, "goodsId": "sz0001", "itemLevel": 1, "notice": False, "rareLevel": 5, "slotNum": 4},
    {"attributes": "{}", "bind": 0, "expireTime": 0, "expired": False, "goodsCount": 50, "goodsId": "baoshihuodong4", "itemLevel": 1, "notice": False, "rareLevel": 4, "slotNum": 5}
]

gift_json = json.dumps(gift_items, ensure_ascii=False)

cursor.execute("""
    INSERT INTO dntg.role_email 
    (id, title, content, user_role_id, jb, yb, attachments, create_time, valid_time, state, send_role_name)
    VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, 0, %s)
""", (
    new_mail_id,
    "★ [GM] Quà Tri Ân & Tân Thủ Đặc Biệt",
    "Chúc mừng bạn! Đây là phần quà hỗ trợ đặc biệt gồm 50 triệu Vàng, 5 triệu KNB và nhiều vật phẩm quý hiếm.",
    "fu0UR1-15-0-1",
    50000000, # 50,000,000 Vàng
    5000000,  # 5,000,000 KNB
    gift_json,
    now_ms,
    now_ms + 30 * 86400 * 1000,
    "Ban Quản Trị GM"
))

conn.commit()
print(f"Created new gift email {new_mail_id} successfully!")

# Kiểm tra lại tất cả các email còn lại của fu0UR1-15-0-1
cursor.execute("SELECT id, title, attachments FROM dntg.role_email WHERE user_role_id='fu0UR1-15-0-1'")
emails = cursor.fetchall()
print(f"\nRemaining emails for fu0UR1-15-0-1: {len(emails)}")
for eid, title, att in emails:
    status = "OK"
    if att:
        try:
            json.loads(att)
        except:
            status = "ERR_JSON"
    print(f"  [{status}] {eid}: {title}")

conn.close()
