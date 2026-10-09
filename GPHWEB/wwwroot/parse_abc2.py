# -*- coding: utf-8 -*-
import zlib, struct

data = open(r'D:\server\GPHWEB\wwwroot\res\Main.swf', 'rb').read()
body = zlib.decompress(data[8:])

abc_data = body[7564+11:7564+15662]

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

def read_s32(buf, p):
    return read_u30(buf, p)

p = 4 # skip major/minor
# ints
count, p = read_u30(abc_data, p)
ints = [0]
for _ in range(count - 1):
    val, p = read_s32(abc_data, p)
    ints.append(val)

# uints
count, p = read_u30(abc_data, p)
uints = [0]
for _ in range(count - 1):
    val, p = read_u30(abc_data, p)
    uints.append(val)

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
namespaces = [('', '')]
for _ in range(ns_count - 1):
    kind = abc_data[p]
    p += 1
    name_idx, p = read_u30(abc_data, p)
    namespaces.append((kind, strings[name_idx] if name_idx < len(strings) else ''))

# ns sets
nss_count, p = read_u30(abc_data, p)
ns_sets = [[]]
for _ in range(nss_count - 1):
    c, p = read_u30(abc_data, p)
    s = []
    for _ in range(c):
        idx, p = read_u30(abc_data, p)
        s.append(idx)
    ns_sets.append(s)

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

print(f"Total strings: {len(strings)}, multinames: {len(multinames)}")

# Find index of 'assets/tg.swf?v=' in strings
tg_str_idx = [i for i, s in enumerate(strings) if 'tg.swf' in s]
print('tg.swf string index:', tg_str_idx)
for i, m in enumerate(multinames):
    if any(k in m for k in ['loadBytes', 'readByte', 'writeByte', 'position', 'xor', 'bytesAvailable']):
        print(f"mn[{i}] = {m}")
