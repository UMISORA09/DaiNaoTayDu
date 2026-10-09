# -*- coding: utf-8 -*-
import zlib, pyamf

p = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\maps.dat'
raw = open(p, 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]

print("Type of maps.dat:", type(obj))
if isinstance(obj, list):
    print(f"Total maps: {len(obj)}")
    for m in obj:
        mid = m.get('id')
        if mid in [4, 16, 23, 24, 14, 52, 63, 62, 82, 89, 104, 107, 115, 117, 120] or str(mid) in ['107', '115', '117', '120']:
            print(f"Map ID: {mid}, Name: {m.get('name')}, Level: {m.get('level')}, Type: {m.get('type')}, Path: {m.get('path')}")
elif isinstance(obj, dict):
    print(f"Keys in maps.dat: {list(obj.keys())[:20]}")
    for mid in [4, 16, 23, 24, 14, 52, 63, 62, 82, 89, 104, 107, 115, 117, 120, '107', '115', '117', '120']:
        if mid in obj:
            print(f"Map {mid}: {obj[mid]}")
