import pyamf, pymysql, json

with open('server/config/game/sys_config/goods.jat', 'rb') as f:
    dec = pyamf.decode(f.read())
    items = next(dec)[0]
    valid_goods = {item['id'] for item in items if 'id' in item}

conn = pymysql.connect(host='127.0.0.1', port=3306, user='root', password='123456', database='dntg', charset='utf8')
cursor = conn.cursor()
cursor.execute("SELECT id, title, attachments FROM role_email WHERE user_role_id='fu0UR1-15-0-1'")
emails = cursor.fetchall()

bad_emails = []
good_emails = []
for eid, title, att in emails:
    if not att or att.strip() == '' or att.strip() == 'None':
        good_emails.append(eid)
        continue
    try:
        data = json.loads(att)
        has_bad = False
        for it in data:
            gid = it.get('goodsId')
            if gid not in valid_goods:
                print(f"INVALID GOODS [{gid}] in email {eid} ({title})")
                bad_emails.append(eid)
                has_bad = True
                break
        if not has_bad:
            good_emails.append(eid)
    except Exception as e:
        print(f"JSON ERROR in email {eid} ({title}): {e}")
        bad_emails.append(eid)

print(f"\nTotal bad emails: {len(bad_emails)}")
print(f"Total good emails: {len(good_emails)}")
print("Bad emails list:", bad_emails)

# Also check system_email
cursor.execute("SELECT id, title, attachments FROM system_email")
sys_emails = cursor.fetchall()
print(f"\nSystem emails: {len(sys_emails)}")
for eid, title, att in sys_emails:
    if not att or att.strip() == '' or att.strip() == 'None':
        continue
    try:
        data = json.loads(att)
        for it in data:
            gid = it.get('goodsId')
            if gid not in valid_goods:
                print(f"INVALID GOODS [{gid}] in system_email {eid} ({title})")
    except Exception as e:
        print(f"JSON ERROR in system_email {eid} ({title}): {e}")

conn.close()
