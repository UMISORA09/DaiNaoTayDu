# -*- coding: utf-8 -*-
import zlib, pyamf, shutil

jat_path = r'D:\server\server\config\game\sys_config\ChuanSongBiao.jat'
data = open(jat_path, 'rb').read()
try:
    obj = list(pyamf.decode(zlib.decompress(data, -15)))[0]
except:
    obj = list(pyamf.decode(data))[0]


wps = obj['wayPoint']

# 1. Fix f0060
fixed_f60 = False
for wp in wps:
    if wp.get('id') == 'f0060':
        wp['map'] = '89'
        wp['toMap'] = '82'
        wp['toWayPointID'] = 'f0059'
        wp['toX'] = 6
        wp['toY'] = 7
        wp['limit'] = {}
        fixed_f60 = True
        print("Fixed f0060")

# Check if new waypoints already exist
existing_ids = set(wp.get('id') for wp in wps)

new_wps = [
    {
        'id': 'f0070', 'map': '107', 'res': 'chuansong', 'toMap': '115', 'toWayPointID': 'f0071',
        'x': 86, 'y': 102, 'toX': 59, 'toY': 233, 'limit': {}, 'lastCheck': False, 'setp': 0
    },
    {
        'id': 'f0071', 'map': '115', 'res': 'chuansong', 'toMap': '107', 'toWayPointID': 'f0070',
        'x': 59, 'y': 233, 'toX': 86, 'toY': 102, 'limit': {}, 'lastCheck': False, 'setp': 0
    },
    {
        'id': 'f0072', 'map': '115', 'res': 'chuansong', 'toMap': '117', 'toWayPointID': 'f0073',
        'x': 10, 'y': 10, 'toX': 51, 'toY': 217, 'limit': {}, 'lastCheck': False, 'setp': 0
    },
    {
        'id': 'f0073', 'map': '117', 'res': 'chuansong', 'toMap': '115', 'toWayPointID': 'f0072',
        'x': 51, 'y': 217, 'toX': 10, 'toY': 10, 'limit': {}, 'lastCheck': False, 'setp': 0
    },
    {
        'id': 'f0074', 'map': '117', 'res': 'chuansong', 'toMap': '120', 'toWayPointID': 'f0075',
        'x': 15, 'y': 15, 'toX': 4, 'toY': 96, 'limit': {}, 'lastCheck': False, 'setp': 0
    },
    {
        'id': 'f0075', 'map': '120', 'res': 'chuansong', 'toMap': '117', 'toWayPointID': 'f0074',
        'x': 4, 'y': 96, 'toX': 15, 'toY': 15, 'limit': {}, 'lastCheck': False, 'setp': 0
    },
]

for nwp in new_wps:
    if nwp['id'] not in existing_ids:
        wps.append(nwp)
        print(f"Added waypoint {nwp['id']}: {nwp['map']} -> {nwp['toMap']}")

# Encode
plain_bytes = pyamf.encode(obj).getvalue()

all_targets = [
    r'D:\server\server\config\game\sys_config\ChuanSongBiao.jat',
    r'D:\server\server\config\game\sys_config\ChuanSongBiao.dat',
    r'D:\server\GPHWEB\wwwroot\res\java\zhcn\ChuanSongBiao.jat',
    r'D:\server\GPHWEB\wwwroot\res\java\zhcn\ChuanSongBiao.dat'
]

for p in all_targets:
    with open(p, 'wb') as f:
        f.write(plain_bytes)
    print(f"Wrote {p}")

