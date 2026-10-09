# -*- coding: utf-8 -*-
import os, pyamf

for m in ['107', '115', '117', '120']:
    p = os.path.join(r'D:\server\server\config\game\map_config', m, 'map.dat')
    if os.path.exists(p):
        raw = open(p, 'rb').read()
        try:
            obj = list(pyamf.decode(raw))[0]
            print(f"Server map.dat for {m}: w={obj.get('width')}, h={obj.get('height')}, name={obj.get('name')}")
        except Exception as e:
            print(f"Error {m}: {e}")
