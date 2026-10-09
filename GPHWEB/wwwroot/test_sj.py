# -*- coding: utf-8 -*-
import zlib, pyamf

raw = open(r'D:\server\GPHWEB\wwwroot\res\config\zhcn\config.dat', 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]
sj_data = list(pyamf.decode(bytes(obj.get('sj'))))[0]

all_sj = {}
for g in [1, 2]:
    for x in sj_data.get(g, []):
        sid = x.get('id')
        name = x.get('name')
        extra = x.get('extraskills')
        jiangxingtu = x.get('jiangxingtu')
        slots = x.get('slots')
        if sid not in all_sj:
            all_sj[sid] = {'name': name, 'extra': extra, 'jxt': jiangxingtu, 'slots': slots, 'raw': x}

print('=== ALL GENERALS IN CONFIG.DAT (GRADES 1 & 2) ===')
for sid, info in sorted(all_sj.items()):
    print("%-8s | name=%-10s | slots=%-10s | keys=%s" % (sid, info['name'], str(info['slots']), list(info['raw'].keys())))
