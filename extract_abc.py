# -*- coding: utf-8 -*-
import zlib, re

raw = open(r'D:\server\GPHWEB\wwwroot\res\assets\tzBoss.swf', 'rb').read()
if raw[:3] == b'CWS':
    data = b'FWS' + raw[3:8] + zlib.decompress(raw[8:])
else:
    data = raw

# Find DoABC tags (tag type 82 = 0x52)
# In SWF tag header: (tagCode << 6) | tagLength (or 0x3F then 32-bit length)
pos = 21 # start after header
while pos < len(data):
    tag_hdr = int.from_bytes(data[pos:pos+2], 'little')
    pos += 2
    tag_type = tag_hdr >> 6
    tag_len = tag_hdr & 0x3f
    if tag_len == 0x3f:
        tag_len = int.from_bytes(data[pos:pos+4], 'little')
        pos += 4
    if tag_type == 82: # DoABC
        abc_data = data[pos:pos+tag_len]
        # find string constant pool or all strings in ABC
        # ABC magic: 16-bit minor, 16-bit major
        flags = int.from_bytes(abc_data[:4], 'little')
        # name string (null terminated)
        name_end = abc_data.find(b'\x00', 4)
        print("DoABC name:", abc_data[4:name_end])
        # Find all UTF-8 / printable strings in abc_data
        strs = re.findall(rb'[a-zA-Z0-9_\$]{3,}', abc_data)
        strs_clean = set(s.decode('ascii', errors='ignore') for s in strs)
        interesting = [s for s in strs_clean if any(w in s.lower() for w in ['map', 'boss', 'click', 'goto', 'nav', 'pos', 'fly', 'tele', 'line'])]
        print("Interesting identifiers:", sorted(interesting))
    pos += tag_len
