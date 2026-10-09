# -*- coding: utf-8 -*-
import os, struct, zlib, pyamf

cfg_path = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\config.dat'
raw = open(cfg_path, 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]
bs_items = list(pyamf.decode(bytes(obj.get('bs'))))[0]

for it in sorted(bs_items, key=lambda x: x.get('number', 0))[:10]:
    num = it.get('number')
    map_str = it.get('mapid')
    mid, coords = map_str.split('|')
    x, y = map(int, coords.split(':'))
    p = os.path.join(r'D:\server\server\config\game\map_config', mid, 'path.mm')
    raw_p = open(p, 'rb').read()
    w, h = struct.unpack('>II', raw_p[:8])
    val = raw_p[8 + y * w + x]
    print(f"Boss {num} ({it.get('name')}): Map {mid} at ({x}, {y}) => val={val} ({'WALKABLE' if val == 0 else 'BLOCKED'})")
