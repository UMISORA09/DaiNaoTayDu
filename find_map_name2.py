# -*- coding: utf-8 -*-
import os, zlib, pyamf

name_cn = "五庄观"
utf8_b = name_cn.encode('utf-8')
gbk_b = name_cn.encode('gbk')

for root, dirs, files in os.walk(r'D:\server\GPHWEB\wwwroot\res\config'):
    for f in files:
        p = os.path.join(root, f)
        try:
            raw = open(p, 'rb').read()
            if utf8_b in raw or gbk_b in raw:
                print(f"Direct match in file: {p}")
            if p.endswith('.dat'):
                try:
                    decomp = zlib.decompress(raw, -15)
                    if utf8_b in decomp or gbk_b in decomp:
                        print(f"Decompressed match in: {p}")
                except Exception:
                    pass
        except Exception:
            pass

for root, dirs, files in os.walk(r'D:\server\server\config'):
    for f in files:
        p = os.path.join(root, f)
        try:
            raw = open(p, 'rb').read()
            if utf8_b in raw or gbk_b in raw:
                print(f"Server match: {p}")
        except Exception:
            pass
