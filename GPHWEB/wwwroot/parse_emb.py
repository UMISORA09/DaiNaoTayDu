# -*- coding: utf-8 -*-
import zlib, struct

data = open(r'D:\server\GPHWEB\wwwroot\embedded.swf', 'rb').read()

nbits = data[8] >> 3
rect_bits = 5 + nbits * 4
rect_bytes = (rect_bits + 7) // 8
pos = 8 + rect_bytes + 4

abc_data = None
while pos < len(data) - 2:
    tag_header = struct.unpack('<H', data[pos:pos+2])[0]
    pos += 2
    tag_type = tag_header >> 6
    tag_len = tag_header & 0x3f
    if tag_len == 0x3f:
        if pos + 4 > len(data): break
        tag_len = struct.unpack('<I', data[pos:pos+4])[0]
        pos += 4
    if pos + tag_len > len(data): break
    tag_data = data[pos:pos+tag_len]
    pos += tag_len
    if tag_type in (82, 72):
        abc_data = tag_data
        break

def read_u30(buf, p):
    res = 0
    shift = 0
    while True:
        b = buf[p]
        p += 1
        res |= (b & 0x7f) << shift
        if not (b & 0x80):
            break
        shift += 7
    return res, p

flags = abc_data[:4]
name_end = abc_data.find(b'\x00', 4)
p = name_end + 1 + 4

count, p = read_u30(abc_data, p)
for _ in range(count - 1): read_u30(abc_data, p)
count, p = read_u30(abc_data, p)
for _ in range(count - 1): read_u30(abc_data, p)
count, p = read_u30(abc_data, p)
p += (count - 1) * 8 if count > 0 else 0

str_count, p = read_u30(abc_data, p)
strings = ['']
for _ in range(str_count - 1):
    slen, p = read_u30(abc_data, p)
    s = abc_data[p:p+slen].decode('utf-8', errors='ignore')
    p += slen
    strings.append(s)

ns_count, p = read_u30(abc_data, p)
namespaces = [('', '')]
for _ in range(ns_count - 1):
    kind = abc_data[p]
    p += 1
    name_idx, p = read_u30(abc_data, p)
    namespaces.append((kind, strings[name_idx] if name_idx < len(strings) else ''))

nss_count, p = read_u30(abc_data, p)
for _ in range(nss_count - 1):
    c, p = read_u30(abc_data, p)
    for _ in range(c): read_u30(abc_data, p)

mn_count, p = read_u30(abc_data, p)
multinames = ['']
for _ in range(mn_count - 1):
    kind = abc_data[p]
    p += 1
    if kind in (0x07, 0x0d):
        ns_idx, p = read_u30(abc_data, p)
        name_idx, p = read_u30(abc_data, p)
        multinames.append(strings[name_idx] if name_idx < len(strings) else f'mn_{name_idx}')
    elif kind in (0x0f, 0x10):
        name_idx, p = read_u30(abc_data, p)
        multinames.append(strings[name_idx] if name_idx < len(strings) else f'mn_{name_idx}')
    elif kind in (0x11, 0x12):
        multinames.append('RTQNameL')
    elif kind in (0x09, 0x0e):
        name_idx, p = read_u30(abc_data, p)
        ns_set_idx, p = read_u30(abc_data, p)
        multinames.append(strings[name_idx] if name_idx < len(strings) else f'mn_{name_idx}')
    elif kind in (0x1b, 0x1c):
        ns_set_idx, p = read_u30(abc_data, p)
        multinames.append('MultinameL')
    elif kind == 0x1d:
        name_idx, p = read_u30(abc_data, p)
        c, p = read_u30(abc_data, p)
        for _ in range(c): read_u30(abc_data, p)
        multinames.append(strings[name_idx] if name_idx < len(strings) else f'mn_{name_idx}')

for i, m in enumerate(multinames):
    print(f"mn[{i}] = {m}")
