import json, re, pymysql

valid_goods = set()
with open('server/config/game/sys_config/goods.jat', 'r', encoding='utf-8', errors='ignore') as f:
    for line in f:
        matches = re.findall(r'"id"\s*:\s*"([^"]+)"', line)
        for gid in matches:
            valid_goods.add(gid)

print(f"Total valid goods in goods.jat: {len(valid_goods)}")
for test_id in ['w10045', 'w10021', 'w10005', 'exppill_005', 'tz0901', 'feixie', '120jianding1']:
    print(f"{test_id} exists: {test_id in valid_goods}")

conn = pymysql.connect(host='127.0.0.1', port=3306, user='root', password='123456', database='dntg', charset='utf8')
cursor = conn.cursor()
cursor.execute("SELECT id, title, attachments FROM role_email WHERE user_role_id='fu0UR1-15-0-1'")
emails = cursor.fetchall()

print(f"\nUser fu0UR1-15-0-1 has {len(emails)} emails:")
invalid_emails = []
for eid, title, att in emails:
    if not att or att.strip() == "":
        continue
    # try parsing att
    try:
        items = json.loads(att)
        for item in items:
            gid = item.get('goodsId')
            if gid not in valid_goods:
                print(f"INVALID ITEM: email_id={eid}, title={title}, goodsId={gid}")
                invalid_emails.append(eid)
    except Exception as e:
        print(f"JSON PARSE ERROR: email_id={eid}, title={title}, error={e}, att={att[:80]}")
        invalid_emails.append(eid)

print(f"\nTotal invalid email count: {len(invalid_emails)}")
conn.close()
