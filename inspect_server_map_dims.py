# -*- coding: utf-8 -*-
import os, zlib, pyamf

for m in ['107', '115', '117', '120']:
    p = os.path.join(r'D:\server\server\config\game\map_config', m, 'map.dat')
    raw = open(p, 'rb').read()
    try:
        decomp = zlib.decompress(raw)
    except Exception:
        decomp = zlib.decompress(raw, -15)
    obj = list(pyamf.decode(decomp))[0]
    print(f"Server map {m}: w={obj.get('width')}, h={obj.get('height')}, name={obj.get('name')}")
