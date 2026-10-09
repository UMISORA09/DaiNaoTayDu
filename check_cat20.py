import pymysql, json, pyamf

with open('server/config/game/sys_config/goods.jat', 'rb') as f:
    items = next(pyamf.decode(f.read()))[0]
cat_map = {it['id']: it.get('category') for it in items if 'id' in it}

conn = pymysql.connect(host='127.0.0.1', port=3306, user='root', password='123456', database='dntg', charset='utf8')
cursor = conn.cursor()
cursor.execute("SELECT id, title, attachments FROM role_email WHERE user_role_id='fu0UR1-15-0-1'")
rows = cursor.fetchall()

print(f"Total emails: {len(rows)}")
cat20_emails = []
for eid, title, att in rows:
    if att:
        try:
            data = json.loads(att)
            for it in data:
                gid = it.get('goodsId')
                cat = cat_map.get(gid)
                if cat == 20:
                    print(f"EMAIL HAS CAT 20: {eid} ({title}) -> {gid}")
                    cat20_emails.append(eid)
                    break
        except Exception as e:
            print("JSON err:", eid, e)

print(f"Total cat 20 emails: {len(cat20_emails)}")
