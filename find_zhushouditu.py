# -*- coding: utf-8 -*-
import os, zlib

target_utf8 = "驻守地图".encode('utf-8')
target_gbk = "驻守地图".encode('gbk')

for root, dirs, files in os.walk(r'D:\server\GPHWEB\wwwroot'):
    for f in files:
        if f.endswith(('.swf', '.dat', '.jat', '.xml', '.txt', '.php', '.js')):
            p = os.path.join(root, f)
            try:
                raw = open(p, 'rb').read()
                if target_utf8 in raw or target_gbk in raw:
                    print(f"Direct found in: {p}")
                if raw[:3] in (b'CWS', b'ZWS'):
                    try:
                        decomp = zlib.decompress(raw[8:])
                        if target_utf8 in decomp or target_gbk in decomp:
                            print(f"Decomp SWF found in: {p}")
                    except Exception:
                        pass
                elif p.endswith('.dat'):
                    try:
                        decomp = zlib.decompress(raw, -15)
                        if target_utf8 in decomp or target_gbk in decomp:
                            print(f"Decomp DAT found in: {p}")
                    except Exception:
                        pass
            except Exception:
                pass
