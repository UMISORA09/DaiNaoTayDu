# -*- coding: utf-8 -*-
import zlib, re

raw = open(r'D:\server\GPHWEB\wwwroot\res\assets\zhcn\tg.swf', 'rb').read()
data = raw if raw[:3] == b'FWS' else b'FWS' + raw[3:8] + zlib.decompress(raw[8:])

# Let's find ABC blocks
pos = 21
abc_blocks = []
while pos < len(data):
    tag_hdr = int.from_bytes(data[pos:pos+2], 'little')
    pos += 2
    tag_type = tag_hdr >> 6
    tag_len = tag_hdr & 0x3f
    if tag_len == 0x3f:
        tag_len = int.from_bytes(data[pos:pos+4], 'little')
        pos += 4
    if tag_type in (82, 72): # DoABC
        abc_blocks.append(data[pos:pos+tag_len])
    pos += tag_len

print(f"Total DoABC tags in tg.swf: {len(abc_blocks)}")

for idx, abc in enumerate(abc_blocks):
    # Find classes or methods containing Boss or TiaoZhan
    strs = re.findall(rb'[a-zA-Z0-9_\$]{4,}', abc)
    all_s = [s.decode('ascii', errors='ignore') for s in strs]
    boss_s = [s for s in all_s if any(k in s.lower() for k in ['bosstiaozhan', 'tzboss', 'bossview', 'bossmediator', 'bosscontrol'])]
    if boss_s:
        print(f"ABC block {idx} has boss strings:", set(boss_s))
