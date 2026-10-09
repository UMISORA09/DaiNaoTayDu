# -*- coding: utf-8 -*-
import zlib, pyamf

p = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\versions.dat'
raw = open(p, 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]

print("Type of versions.dat:", type(obj))
if isinstance(obj, dict):
    print(f"Total entries: {len(obj)}")
    # search for boss
    for k in obj.keys():
        if 'boss' in k.lower():
            print(f"  {k} => {obj[k]}")
