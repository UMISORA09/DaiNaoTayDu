# -*- coding: utf-8 -*-
import zlib

def decompress_swf(path):
    raw = open(path, 'rb').read()
    magic = raw[:3]
    if magic == b'CWS':
        return b'FWS' + raw[3:8] + zlib.decompress(raw[8:])
    elif magic == b'FWS':
        return raw
    return raw

swf = decompress_swf(r'D:\server\GPHWEB\wwwroot\res\assets\zhcn\bossplaces.swf')
print("bossplaces.swf decompressed size:", len(swf))
# Search for strings in decompressed swf
import re
strings = re.findall(rb'[\x20-\x7e]{4,}', swf)
print(f"Total ASCII strings: {len(strings)}")
for s in strings:
    s_str = s.decode('ascii', errors='ignore')
    if any(k in s_str.lower() for k in ['boss', 'map', 'teleport', 'path', '120', '140', '115', '117', 'point', 'goto']):
        print("  ", s_str)

