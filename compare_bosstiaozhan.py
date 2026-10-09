# -*- coding: utf-8 -*-
import pyamf, zlib, os

files = [
    r'D:\server\server\config\game\sys_config\BossTiaoZhan.dat',
    r'D:\server\server\config\game\sys_config\BossTiaoZhan.jat',
    r'D:\server\GPHWEB\wwwroot\res\java\zhcn\BossTiaoZhan.dat',
    r'D:\server\GPHWEB\wwwroot\res\java\zhcn\BossTiaoZhan.jat',
]

for p in files:
    if os.path.exists(p):
        raw = open(p, 'rb').read()
        print(f"File: {p}, size: {len(raw)}")
        try:
            # try direct AMF
            obj = list(pyamf.decode(raw))[0]
            print(f"  Direct AMF decoded: {len(obj)} items")
            print(f"  Numbers: {[x.get('number') for x in obj]}")
        except Exception as e1:
            try:
                # try zlib
                decomp = zlib.decompress(raw, -15)
                obj = list(pyamf.decode(decomp))[0]
                print(f"  Zlib AMF decoded: {len(obj)} items")
            except Exception as e2:
                print(f"  Failed decode: e1={e1}, e2={e2}")
