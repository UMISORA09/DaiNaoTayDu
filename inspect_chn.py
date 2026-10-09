# -*- coding: utf-8 -*-
import zlib, pyamf

p = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\chn.dat'
raw = open(p, 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]

print("Type of chn.dat:", type(obj))
if isinstance(obj, dict):
    print("Total keys in chn.dat:", len(obj))
    # search for boss names or map names or zhushouditu
    for k, v in list(obj.items())[:20]:
        print(f"  {k} => {v}")

    # search specifically
    matches = {k: v for k, v in obj.items() if any(w in str(v) for w in ["驻守地图", "镇元子", "红孩儿", "神将", "降龙罗汉"])}
    print(f"Matches count: {len(matches)}")
    for k, v in matches.items():
        print(f"  MATCH: {k} => {v}")

