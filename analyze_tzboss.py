# -*- coding: utf-8 -*-
import zlib, re

def decompress_swf(path):
    raw = open(path, 'rb').read()
    magic = raw[:3]
    if magic == b'CWS':
        return b'FWS' + raw[3:8] + zlib.decompress(raw[8:])
    elif magic == b'FWS':
        return raw
    return raw

swf = decompress_swf(r'D:\server\GPHWEB\wwwroot\res\assets\tzBoss.swf')
print("tzBoss.swf decompressed size:", len(swf))
strings = re.findall(rb'[\x20-\x7e]{4,}', swf)
print(f"Total ASCII strings in tzBoss: {len(strings)}")
keywords = ['map', 'mapid', 'monsterid', 'teleport', 'path', 'move', 'auto', 'fly', 'chuan', 'xunlu', 'find']
for s in strings:
    s_str = s.decode('ascii', errors='ignore')
    if any(k in s_str.lower() for k in keywords):
        print("  ", s_str)
