# -*- coding: utf-8 -*-
import zlib, pyamf, json

# 1. Load valid goods
valid_goods = set()
raw = open(r'D:\server\GPHWEB\wwwroot\res\config\zhcn\goods.dat', 'rb').read()
obj = list(pyamf.decode(zlib.decompress(raw, -15)))[0]
for g in obj:
    if isinstance(g, dict) and 'id' in g:
        valid_goods.add(str(g['id']))

print(f"Total valid goods: {len(valid_goods)}")

# 2. Read emails.txt
lines = open(r'd:\server\emails.txt', 'r', encoding='utf-8', errors='ignore').readlines()
invalid_ids = []
for line in lines[1:]: # skip header
    parts = line.strip().split('\t')
    if len(parts) < 2:
        continue
    eid = parts[0]
    att = parts[1]
    if att in ('NULL', ''):
        continue
    try:
        items = json.loads(att)
        for it in items:
            gid = str(it.get('goodsId'))
            if gid not in valid_goods:
                print(f"INVALID: email={eid}, goodsId='{gid}'")
                invalid_ids.append(eid)
    except Exception as e:
        print(f"JSON ERROR: email={eid}, err={e}")
        invalid_ids.append(eid)

print(f"Total invalid emails: {len(invalid_ids)}")
