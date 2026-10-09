# -*- coding: utf-8 -*-
import zlib, pyamf

path = r'D:\server\server\config\game\sys_config\ChuanSongBiao.jat'
data = open(path, 'rb').read()
try:
    obj = list(pyamf.decode(zlib.decompress(data, -15)))[0]
except:
    obj = list(pyamf.decode(data))[0]

wps = obj['wayPoint']
boss_maps = ['82', '89', '107', '115', '117', '120']

print("=== ALL WAYPOINTS IN CHUANSONGBIAO ===")
for wp in sorted(wps, key=lambda x: (int(x.get('map', 0)) if str(x.get('map', 0)).isdigit() else 999)):
    m = str(wp.get('map'))
    tom = str(wp.get('toMap'))
    print("%-4s -> %-4s | id=%-6s | toWP=%-6s | (%3s,%3s) -> (%3s,%3s) | limit=%s" % (
        m, tom, str(wp.get('id')), str(wp.get('toWayPointID')),
        str(wp.get('x')), str(wp.get('y')), str(wp.get('toX')), str(wp.get('toY')), str(wp.get('limit'))
    ))

