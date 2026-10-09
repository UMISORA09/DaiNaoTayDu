# -*- coding: utf-8 -*-
import zlib, struct

data = open(r'D:\server\GPHWEB\wwwroot\res\Main.swf', 'rb').read()
body = zlib.decompress(data[8:])

nbits = body[0] >> 3
rect_bits = 5 + nbits * 4
rect_bytes = (rect_bits + 7) // 8
pos = rect_bytes + 4

abc_data = None
while pos < len(body) - 2:
    tag_header = struct.unpack('<H', body[pos:pos+2])[0]
    pos += 2
    tag_type = tag_header >> 6
    tag_len = tag_header & 0x3f
    if tag_len == 0x3f:
        if pos + 4 > len(body): break
        tag_len = struct.unpack('<I', body[pos:pos+4])[0]
        pos += 4
    if pos + tag_len > len(body): break
    tag_data = body[pos:pos+tag_len]
    pos += tag_len
    if tag_type in (82, 72): # DoABC
        abc_data = tag_data
        break

# Parse ABC
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

p = 4 # skip flags and name
# major, minor
p += 4

# cpool
# ints
count, p = read_u30(abc_data, p)
for _ in range(count - 1):
    val, p = read_u30(abc_data, p)

# uints
count, p = read_u30(abc_data, p)
for _ in range(count - 1):
    val, p = read_u30(abc_data, p)

# doubles
count, p = read_u30(abc_data, p)
p += (count - 1) * 8 if count > 0 else 0

# strings
str_count, p = read_u30(abc_data, p)
strings = ['']
for _ in range(str_count - 1):
    slen, p = read_u30(abc_data, p)
    s = abc_data[p:p+slen].decode('utf-8', errors='ignore')
    p += slen
    strings.append(s)

# namespaces
ns_count, p = read_u30(abc_data, p)
namespaces = []
for _ in range(ns_count - 1):
    kind = abc_data[p]
    p += 1
    name_idx, p = read_u30(abc_data, p)
    namespaces.append((kind, strings[name_idx] if name_idx < len(strings) else ''))

# ns sets
nss_count, p = read_u30(abc_data, p)
for _ in range(nss_count - 1):
    c, p = read_u30(abc_data, p)
    for _ in range(c):
        _, p = read_u30(abc_data, p)

# multinames
mn_count, p = read_u30(abc_data, p)
multinames = ['']
for _ in range(mn_count - 1):
    kind = abc_data[p]
    p += 1
    if kind in (0x07, 0x0d): # QName
        ns_idx, p = read_u30(abc_data, p)
        name_idx, p = read_u30(abc_data, p)
        multinames.append(strings[name_idx] if name_idx < len(strings) else f'mn_{name_idx}')
    elif kind in (0x0f, 0x10): # RTQName
        name_idx, p = read_u30(abc_data, p)
        multinames.append(strings[name_idx] if name_idx < len(strings) else f'mn_{name_idx}')
    elif kind in (0x11, 0x12): # RTQNameL
        multinames.append('RTQNameL')
    elif kind in (0x09, 0x0e): # Multiname
        name_idx, p = read_u30(abc_data, p)
        ns_set_idx, p = read_u30(abc_data, p)
        multinames.append(strings[name_idx] if name_idx < len(strings) else f'mn_{name_idx}')
    elif kind in (0x1b, 0x1c): # MultinameL
        ns_set_idx, p = read_u30(abc_data, p)
        multinames.append('MultinameL')
    elif kind == 0x1d: # TypeName
        name_idx, p = read_u30(abc_data, p)
        c, p = read_u30(abc_data, p)
        for _ in range(c):
            _, p = read_u30(abc_data, p)
        multinames.append(strings[name_idx] if name_idx < len(strings) else f'mn_{name_idx}')

print(f"Total strings: {len(strings)}")
for i, s in enumerate(strings):
    print(f"{i}: {repr(s)}")

