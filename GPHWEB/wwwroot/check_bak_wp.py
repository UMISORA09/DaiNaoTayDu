# -*- coding: utf-8 -*-
import zlib, pyamf

path = r'D:\server\server\config\game\sys_config\ChuanSongBiao.jat.bak'
data = open(path, 'rb').read()
try:
    obj = list(pyamf.decode(zlib.decompress(data, -15)))[0]
except:
    obj = list(pyamf.decode(data))[0]

print("Bak wayPoint count:", len(obj['wayPoint']))
for wp in obj['wayPoint']:
    m = str(wp.get('map'))
    tom = str(wp.get('toMap'))
    if any(k in [m, tom] for k in ['115', '117', '120', '89', '107']):
        print("%s -> %s | id=%s | toWP=%s" % (m, tom, wp.get('id'), wp.get('toWayPointID')))
