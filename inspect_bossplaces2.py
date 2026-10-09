# -*- coding: utf-8 -*-
import zlib

raw = open(r'D:\server\GPHWEB\wwwroot\res\assets\zhcn\bossplaces.swf', 'rb').read()
if raw[:3] == b'CWS':
    data = b'FWS' + raw[3:8] + zlib.decompress(raw[8:])
else:
    data = raw

pos = 21
symbol_classes = []
while pos < len(data):
    tag_hdr = int.from_bytes(data[pos:pos+2], 'little')
    pos += 2
    tag_type = tag_hdr >> 6
    tag_len = tag_hdr & 0x3f
    if tag_len == 0x3f:
        tag_len = int.from_bytes(data[pos:pos+4], 'little')
        pos += 4
    tag_body = data[pos:pos+tag_len]
    pos += tag_len
    if tag_type == 76: # SymbolClass
        count = int.from_bytes(tag_body[:2], 'little')
        p = 2
        for _ in range(count):
            char_id = int.from_bytes(tag_body[p:p+2], 'little')
            p += 2
            null_pos = tag_body.find(b'\x00', p)
            name = tag_body[p:null_pos].decode('utf-8', errors='ignore')
            p = null_pos + 1
            symbol_classes.append((char_id, name))

print(f"SymbolClass ({len(symbol_classes)}):")
for ch, name in symbol_classes:
    print(f"  {ch}: {name}")
