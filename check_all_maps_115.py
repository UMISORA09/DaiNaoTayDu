# -*- coding: utf-8 -*-
import os, zlib, pyamf

for root, dirs, files in os.walk(r'D:\server\GPHWEB\wwwroot\res\config'):
    for f in files:
        if f.startswith('maps') and f.endswith('.dat'):
            p = os.path.join(root, f)
            try:
                raw = open(p, 'rb').read()
                obj = list(pyamf.decode(zlib.decompress(raw, -15)))[0]
                if '115' in obj:
                    print(f"{p} -> Map 115 width={obj['115'].get('width')}, height={obj['115'].get('height')}")
            except Exception as e:
                pass
