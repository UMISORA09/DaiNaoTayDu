# -*- coding: utf-8 -*-
import zlib, pyamf

raw = open(r'D:\server\GPHWEB\wwwroot\res\config\zhcn\maps.dat', 'rb').read()
obj = list(pyamf.decode(zlib.decompress(raw, -15)))[0]

for mid in ['82', '89', '107', '108', '115', '117', '120']:
    m = obj.get(mid)
    if m:
        print("Map %-4s | name=%-15s | size=(%3s, %3s) | path=%s" % (
            mid, m.get('name'), str(m.get('width')), str(m.get('height')), m.get('path')
        ))
