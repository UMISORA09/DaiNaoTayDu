# -*- coding: utf-8 -*-
import pyamf

path = r'D:\server\server\config\game\sys_config\GuaiWuBiao.jat'
obj = list(pyamf.decode(open(path, 'rb').read()))[0]

check_ids = ['B100009', 'B100010', 'B100011', 'B100012', 'B100013', 'B100014', 'B200013', 'B200014', 'B200015', 'B200016', 'B200017']
gw_ids = {x.get('id'): x for x in obj}

for cid in check_ids:
    if cid in gw_ids:
        print("%s: found -> %s" % (cid, gw_ids[cid].get('name')))
    else:
        print("%s: NOT FOUND" % cid)
