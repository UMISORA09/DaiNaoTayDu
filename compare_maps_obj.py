# -*- coding: utf-8 -*-
import zlib, pyamf

p = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\maps.dat'
raw = open(p, 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]

for mid in ['4', '89', '107', '115', '117', '120']:
    if mid in obj:
        m = obj[mid]
        # print keys and values except bytes
        info = {k: v for k, v in m.items() if k not in ['bytes', 'monsterList']}
        print(f"Map {mid}: {info}")
