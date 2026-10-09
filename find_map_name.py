# -*- coding: utf-8 -*-
import zlib, pyamf

cfg_path = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\config.dat'
raw = open(cfg_path, 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]

target = "五庄观"
target_bytes = target.encode('utf-8')

print("Searching for map name in config.dat keys...")
for k in obj.keys():
    v = obj[k]
    if isinstance(v, (bytes, bytearray)):
        if target_bytes in v:
            print(f"Found in key: {k} (ByteArray)")
    elif isinstance(v, str):
        if target in v:
            print(f"Found in key: {k} (str)")
    elif isinstance(v, dict):
        if target in str(v):
            print(f"Found in key: {k} (dict)")
    elif isinstance(v, list):
        if target in str(v):
            print(f"Found in key: {k} (list)")

