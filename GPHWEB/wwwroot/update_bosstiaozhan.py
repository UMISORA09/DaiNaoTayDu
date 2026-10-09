# -*- coding: utf-8 -*-
import zlib, pyamf

# Read bs from config.dat
raw = open(r'D:\server\GPHWEB\wwwroot\res\config\zhcn\config.dat', 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]
val_bs = bytes(obj.get('bs'))
bs_items = list(pyamf.decode(val_bs))[0]

# Read current BossTiaoZhan.jat
bt_path = r'D:\server\server\config\game\sys_config\BossTiaoZhan.jat'
bt_items = list(pyamf.decode(open(bt_path, 'rb').read()))[0]

bt_numbers = set(x.get('number') for x in bt_items)
missing_numbers = [10, 23, 36, 37, 38, 39, 40, 41, 42, 43]

added = 0
for x in bs_items:
    num = x.get('number')
    if num in missing_numbers and num not in bt_numbers:
        # Create full entry matching BossTiaoZhan schema
        entry = dict(x)
        entry['finishtime'] = ''
        entry['starttime'] = ''
        entry['talk'] = ''
        entry['url'] = ''
        entry['icon'] = ''
        entry['gonggao'] = entry.get('gonggao', 0)
        entry['type'] = entry.get('type', 0)
        entry['delay'] = entry.get('delay', 300)
        bt_items.append(entry)
        bt_numbers.add(num)
        added += 1
        print(f"Added boss {num}: {entry.get('name')} (monster {entry.get('monsterid')}, map {entry.get('mapid')})")

print(f"Total new bosses added: {added}, total in BossTiaoZhan: {len(bt_items)}")

# Encode as plain AMF
plain_bytes = pyamf.encode(bt_items).getvalue()

targets = [
    r'D:\server\server\config\game\sys_config\BossTiaoZhan.jat',
    r'D:\server\GPHWEB\wwwroot\res\java\zhcn\BossTiaoZhan.jat'
]

for p in targets:
    with open(p, 'wb') as f:
        f.write(plain_bytes)
    print(f"Wrote {p}")
