# -*- coding: utf-8 -*-
import zlib, pyamf, json, MySQLdb

# 1. Load all valid goodsIds from client goods.dat or config.dat
valid_goods = set()

# Load goods.dat
p_goods = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\goods.dat'
raw = open(p_goods, 'rb').read()
obj = list(pyamf.decode(zlib.decompress(raw, -15)))[0]
for g in obj:
    if isinstance(g, dict) and 'id' in g:
        valid_goods.add(str(g['id']))

# Load config.dat key 'BaoShiShengJi', goods etc if any
print(f"Total valid goods from goods.dat: {len(valid_goods)}")

# 2. Check all attachments in role_email
db = MySQLdb.connect(host="127.0.0.1", user="root", passwd="123456", db="dntg", port=3306, charset="utf8")
cur = db.cursor()
cur.execute("SELECT id, user_role_id, title, attachments FROM role_email WHERE user_role_id='fu0UR1-15-0-1'")
rows = cur.fetchall()

print(f"Total emails for user: {len(rows)}")
invalid_emails = []
for eid, rid, title, att in rows:
    if not att or att.strip() in ('', 'NULL'):
        continue
    try:
        items = json.loads(att)
        for it in items:
            gid = str(it.get('goodsId'))
            if gid not in valid_goods:
                print(f"INVALID GOODS '{gid}' in email id={eid}, title={title}")
                invalid_emails.append((eid, gid, title))
    except Exception as e:
        print(f"JSON parse error in email {eid}: {e}, att={att[:50]}")
        invalid_emails.append((eid, 'PARSE_ERROR', title))

print(f"Total invalid emails found: {len(invalid_emails)}")
