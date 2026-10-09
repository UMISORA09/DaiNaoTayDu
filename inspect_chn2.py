# -*- coding: utf-8 -*-
import zlib, pyamf

p = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\chn.dat'
raw = open(p, 'rb').read()
data = zlib.decompress(raw, -15)
decoded = list(pyamf.decode(data))
print("Decoded length:", len(decoded))
for idx, item in enumerate(decoded):
    print(f"Item {idx}: type={type(item)}, len={len(item) if hasattr(item, '__len__') else 'N/A'}")
    if isinstance(item, dict):
        matches = {k: v for k, v in item.items() if any(w in str(v) for w in ["驻守地图", "镇元子", "红孩儿", "神将", "降龙罗汉"])}
        print(f"  dict matches in item {idx}: {len(matches)}")
        for k, v in list(matches.items())[:10]:
            print(f"    {k} => {v}")
    elif isinstance(item, list):
        print("  list sample:", item[:3])
