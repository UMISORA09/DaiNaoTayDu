import pymysql, json, pyamf, time

with open('server/config/game/sys_config/goods.jat', 'rb') as f:
    items = next(pyamf.decode(f.read()))[0]
cat_map = {it['id']: it.get('category') for it in items if 'id' in it}

conn = pymysql.connect(host='127.0.0.1', port=3306, user='root', password='123456', database='dntg', charset='utf8')
cursor = conn.cursor()

# 1. Tìm tất cả email chứa category 20 trong role_email
cursor.execute("SELECT id, title, attachments FROM role_email WHERE user_role_id='fu0UR1-15-0-1'")
rows = cursor.fetchall()

deleted_eids = []
for eid, title, att in rows:
    if att:
        try:
            data = json.loads(att)
            for it in data:
                gid = it.get('goodsId')
                if cat_map.get(gid) == 20:
                    cursor.execute("DELETE FROM role_email WHERE id=%s", (eid,))
                    deleted_eids.append(eid)
                    print(f"Deleted email {eid} ({title}) containing equip {gid}")
                    break
        except Exception as e:
            cursor.execute("DELETE FROM role_email WHERE id=%s", (eid,))
            deleted_eids.append(eid)
            print(f"Deleted corrupted email {eid}")

# Also delete from system_email any category 20 attachments
cursor.execute("SELECT id, title, attachments FROM system_email")
sys_rows = cursor.fetchall()
for sid, title, att in sys_rows:
    if att:
        try:
            data = json.loads(att)
            for it in data:
                gid = it.get('goodsId')
                if cat_map.get(gid) == 20:
                    cursor.execute("DELETE FROM system_email WHERE id=%s", (sid,))
                    print(f"Deleted system_email {sid} ({title})")
                    break
        except:
            cursor.execute("DELETE FROM system_email WHERE id=%s", (sid,))

# 2. Tạo 1 email quà tặng mới CHUẨN AN TOÀN TUYỆT ĐỐI (không chứa category 20 trực tiếp, mà chứa rương trang bị và vật phẩm xịn)
now_ms = int(time.time() * 1000)
new_mail_id = f"fu0EM1-SAFE-{int(time.time())}"

safe_items = [
    {"attributes": "{}", "bind": 0, "expireTime": 0, "expired": False, "goodsCount": 999, "goodsId": "exppill_005", "itemLevel": 1, "notice": False, "rareLevel": 4, "slotNum": 0},
    {"attributes": "{}", "bind": 0, "expireTime": 0, "expired": False, "goodsCount": 50, "goodsId": "120jianding1", "itemLevel": 1, "notice": False, "rareLevel": 4, "slotNum": 1},
    {"attributes": "{}", "bind": 0, "expireTime": 0, "expired": False, "goodsCount": 50, "goodsId": "baoshihuodong4", "itemLevel": 1, "notice": False, "rareLevel": 4, "slotNum": 2},
    {"attributes": "{}", "bind": 0, "expireTime": 0, "expired": False, "goodsCount": 50, "goodsId": "baoshilibao", "itemLevel": 1, "notice": False, "rareLevel": 4, "slotNum": 3},
    {"attributes": "{}", "bind": 0, "expireTime": 0, "expired": False, "goodsCount": 50, "goodsId": "zq100", "itemLevel": 1, "notice": False, "rareLevel": 4, "slotNum": 4},
    {"attributes": "{}", "bind": 0, "expireTime": 0, "expired": False, "goodsCount": 99, "goodsId": "feixie", "itemLevel": 1, "notice": False, "rareLevel": 3, "slotNum": 5}
]
safe_json = json.dumps(safe_items, ensure_ascii=False)

cursor.execute("""
    INSERT INTO role_email 
    (id, title, content, user_role_id, jb, yb, attachments, create_time, valid_time, receive_time, state, send_role_name)
    VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, 0, %s)
""", (
    new_mail_id,
    "★ [GM] Quà Tặng Tân Thủ & Tri Ân Toàn Diện",
    "Gửi tặng bạn 50 triệu Vàng, 5 triệu KNB, Rương Trang Bị Thần Cấp 120, Rương Tọa Kỵ 100, Đan Siêu Cấp và Lễ Bao Bảo Thạch!",
    "fu0UR1-15-0-1",
    50000000,
    5000000,
    safe_json,
    now_ms,
    now_ms + 30 * 86400 * 1000,
    now_ms,
    "Ban Quản Trị GM"
))

# Ensure all receive_time are set
cursor.execute("UPDATE role_email SET receive_time=create_time WHERE receive_time IS NULL")

conn.commit()
print(f"Successfully deleted {len(deleted_eids)} dangerous emails, created safe email {new_mail_id}")

cursor.execute("SELECT id, title FROM role_email WHERE user_role_id='fu0UR1-15-0-1'")
rem = cursor.fetchall()
print(f"Total remaining emails for user: {len(rem)}")
for r in rem:
    print(" ", r[0], r[1])

conn.close()
