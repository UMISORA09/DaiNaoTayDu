# -*- coding: utf-8 -*-
import zlib, re

raw = open(r'D:\server\GPHWEB\wwwroot\res\assets\tzBoss.swf', 'rb').read()
if raw[:3] == b'CWS':
    data = b'FWS' + raw[3:8] + zlib.decompress(raw[8:])
else:
    data = raw

print("Decompressed length:", len(data))
# Search for ABC header: minor version 16 (0x0010), major version 46 (0x002E) -> b'\x10\x00\x2e\x00'
matches = [m.start() for m in re.finditer(b'\x10\x00\x2e\x00', data)]
print(f"Found ABC headers at: {matches}")
for offset in matches:
    sub = data[offset:offset+50000]
    strs = re.findall(rb'[a-zA-Z0-9_\$]{3,}', sub)
    words = sorted(set(s.decode('ascii', errors='ignore') for s in strs))
    interest = [w for w in words if any(k in w.lower() for k in ['map', 'boss', 'click', 'goto', 'pos', 'fly', 'line', 'transfer', 'path'])]
    print("Words around ABC:", interest[:50])

