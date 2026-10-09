# -*- coding: utf-8 -*-
import zlib, re

raw = open(r'D:\server\GPHWEB\wwwroot\res\assets\zhcn\tg.swf', 'rb').read()
if raw[:3] == b'CWS':
    data = b'FWS' + raw[3:8] + zlib.decompress(raw[8:])
else:
    data = raw

print("tg.swf decompressed:", len(data))
patterns = [b'BossTiaoZhan', b'bossplaces', "驻守地图".encode('utf-8'), "神将".encode('utf-8')]
for p in patterns:
    matches = [m.start() for m in re.finditer(re.escape(p), data)]
    print(f"Pattern {p}: found at {len(matches)} places: {matches[:3]}")

