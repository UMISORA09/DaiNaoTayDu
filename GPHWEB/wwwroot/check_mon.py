# -*- coding: utf-8 -*-
import zlib, pyamf

raw = open(r'D:\server\GPHWEB\wwwroot\res\config\zhcn\config.dat', 'rb').read()
obj = list(pyamf.decode(zlib.decompress(raw, -15)))[0]

monsters = list(pyamf.decode(bytes(obj.get('0'))))[0]
m_dict = {m.get('id'): m for m in monsters if isinstance(m, dict)}
for mid in ['B100009', 'B100010', 'B100011', 'B100012', 'B100013', 'B100014']:
    m = m_dict.get(mid)
    if m:
        print("%s: name=%s | level=%s | hp=%s" % (mid, m.get('name'), m.get('level'), m.get('hp')))
    else:
        print("%s: NOT FOUND" % mid)

