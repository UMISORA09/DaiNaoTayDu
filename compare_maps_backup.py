# -*- coding: utf-8 -*-
import zlib, pyamf, os

for f in ['maps.dat', 'maps_viet_backup.dat', 'maps_backup_viet.dat']:
    p = os.path.join(r'D:\server\GPHWEB\wwwroot\res\config\zhcn', f)
    if os.path.exists(p):
        raw = open(p, 'rb').read()
        obj = list(pyamf.decode(zlib.decompress(raw, -15)))[0]
        print(f"=== {f} ===")
        for m in ['107', '115', '117', '120']:
            if m in obj:
                print(f"  Map {m}: {obj[m].get('name')}")
            else:
                print(f"  Map {m}: NOT FOUND")
