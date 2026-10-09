# -*- coding: utf-8 -*-
import zlib, pyamf

obj = list(pyamf.decode(zlib.decompress(open(r'D:\server\GPHWEB\wwwroot\res\config\zhcn\config.dat', 'rb').read(), -15)))[0]
ml = list(pyamf.decode(bytes(obj['mapline'])))[0]
for m in ml:
    mid = m.get('mapid')
    if mid in [4, 16, 23, 24, 14, 52, 63, 62, 82, 89, 107, 115, 117, 120]:
        print(f"Map {mid}: {m.get('mapname')}, maplv={m.get('maplv')}, fly={m.get('fly')}")
