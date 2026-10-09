# -*- coding: utf-8 -*-
import zlib, pyamf

raw = open(r'D:\server\GPHWEB\wwwroot\res\config\zhcn\config.dat', 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]
sj_data = list(pyamf.decode(bytes(obj.get('sj'))))[0]

in_popup = ['sj0101', 'sj0103', 'sj0104', 'sj0108', 'sj0200', 'sj0201', 'sj0202', 'sj0203', 'sj0204', 'sj0205', 'sj0208', 'sj0210', 'sj0211', 'sj0212']

all_items = {}
for g in [1, 2]:
    for x in sj_data.get(g, []):
        sid = x.get('id')
        if sid not in all_items:
            all_items[sid] = x

for sid, x in sorted(all_items.items()):
    is_in = sid in in_popup
    name = x.get('name', '')
    sort_val = x.get('sort')
    mapf = x.get('mapfenlei')
    qianzhi = x.get('qianzhibianshen')
    restype = x.get('restype')
    simg = x.get('simg')
    nameres = x.get('nameres')
    roundicon = x.get('roundicon')
    print("%-8s | in=%-5s | name=%-8s | sort=%-3s | mapf=%-3s | qianzhi=%-10s | restype=%-3s | simg=%-12s | round=%-10s" % (
        sid, str(is_in), name, str(sort_val), str(mapf), str(qianzhi), str(restype), str(simg), str(roundicon)
    ))
