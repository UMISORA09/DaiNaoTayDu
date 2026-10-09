# -*- coding: utf-8 -*-
import subprocess, json, zlib, pyamf

# 1. Load valid goods from goods.dat
p_goods = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\goods.dat'
raw = open(p_goods, 'rb').read()
obj = list(pyamf.decode(zlib.decompress(raw, -15)))[0]
valid_goods = set()
for g in obj:
    if isinstance(g, dict) and 'id' in g:
        valid_goods.add(str(g['id']))
print(f"Loaded {len(valid_goods)} valid goods from goods.dat")

# 2. Query MySQL directly via subprocess
cmd = [r'D:\server\GPHWEB\MySQL5\bin\mysql.exe', '-uroot', '-p123456', '-e', 
       "SELECT id, attachments FROM dntg.role_email WHERE user_role_id='fu0UR1-15-0-1';", '-B']
proc = subprocess.Popen(cmd, stdout=subprocess.PIPE, stderr=subprocess.PIPE)
out, err = proc.communicate()
lines = out.decode('utf-8', errors='ignore').split('\n')

invalid_emails = []
for line in lines[1:]:
    line = line.strip()
    if not line:
        continue
    parts = line.split('\t')
    eid = parts[0]
    att = parts[1] if len(parts) > 1 else ''
    if not att or att == 'NULL':
        continue
    try:
        items = json.loads(att)
        for it in items:
            gid = str(it.get('goodsId'))
            if gid not in valid_goods:
                print(f"INVALID ITEM: email {eid} has goodsId '{gid}'")
                invalid_emails.append(eid)
    except Exception as e:
        print(f"BAD JSON: email {eid}: {e}")
        invalid_emails.append(eid)

print(f"Invalid emails count: {len(invalid_emails)}")
