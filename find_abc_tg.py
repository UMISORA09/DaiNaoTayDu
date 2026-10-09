# -*- coding: utf-8 -*-
import zlib, re

raw = open(r'D:\server\GPHWEB\wwwroot\tg.swf', 'rb').read()
if raw[:3] == b'CWS':
    data = b'FWS' + raw[3:8] + zlib.decompress(raw[8:])
else:
    data = raw

print("tg.swf decompressed length:", len(data))
matches = [m.start() for m in re.finditer(b'\x10\x00\x2e\x00', data)]
print(f"Found ABC headers in tg.swf at: {len(matches)} locations: {matches[:5]}")
