# -*- coding: utf-8 -*-
import zlib, pyamf

cfg_path = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\config.dat'
raw = open(cfg_path, 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]

for k, v in obj.items():
    if any(w in k.lower() for w in ['map', 'ditu', 'world', 'fb']):
        print(f"Key: {k}, type: {type(v)}")

# Search for 115, 117, 120 in keys
for k, v in obj.items():
    s = str(v)
    if '115' in s and '117' in s and '120' in s:
        print(f"Key {k} contains 115, 117, 120!")
