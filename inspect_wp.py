# -*- coding: utf-8 -*-
import zlib, pyamf

cfg_path = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\config.dat'
raw = open(cfg_path, 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]

val_7 = bytes(obj.get('7'))
key7 = list(pyamf.decode(val_7))[0]
wp = key7['wayPoint']

print(f"Total waypoints: {len(wp)}")
# check map 4, 16, 23, 24, 14, 52, 63, 62, 82, 89, 107, 115, 117, 120
for k, v in list(wp.items())[:20]:
    print(f"WP key {k} => {v}")

# check if any waypoint has map 107, 115, 117, 120
for k, v in wp.items():
    s = str(v)
    for m in ['107', '115', '117', '120']:
        if f"'{m}'" in s or f":{m}" in s or f": {m}" in s:
            print(f"Map {m} referenced in WP {k}: {v}")
