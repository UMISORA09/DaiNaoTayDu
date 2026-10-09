# -*- coding: utf-8 -*-
import zlib, pyamf

obj = list(pyamf.decode(zlib.decompress(open(r'D:\server\GPHWEB\wwwroot\res\config\zhcn\maps.dat', 'rb').read(), -15)))[0]
for m in ['4', '16', '23', '24', '14', '52', '63', '62', '82', '89', '107', '115', '117', '120']:
    print(f"Map {m}: {obj[m].get('name')}")
