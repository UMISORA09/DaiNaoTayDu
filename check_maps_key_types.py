# -*- coding: utf-8 -*-
import zlib, pyamf

p = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\maps.dat'
raw = open(p, 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]

print("Total keys in maps.dat:", len(obj))
for k in sorted(obj.keys(), key=lambda x: (str(type(x)), str(x))):
    if k in [4, '4', 16, '16', 89, '89', 107, '107', 115, '115', 117, '117', 120, '120']:
        print(f"Key: {repr(k)} (type {type(k).__name__}) => name: {obj[k].get('name')}")
