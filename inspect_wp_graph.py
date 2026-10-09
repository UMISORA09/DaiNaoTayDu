# -*- coding: utf-8 -*-
import zlib, pyamf

cfg_path = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\config.dat'
raw = open(cfg_path, 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]

val_7 = bytes(obj.get('7'))
key7 = list(pyamf.decode(val_7))[0]
wp = key7['wayPoint']

maps = ['89', '107', '115', '117', '120']
for m in maps:
    print(f"\n=== WayPoints on Map {m} ===")
    for k, v in wp.items():
        if v.get('map') == m:
            print(f"  ID: {k}, (x={v.get('x')}, y={v.get('y')}) -> toMap={v.get('toMap')} (toX={v.get('toX')}, toY={v.get('toY')}), toWP={v.get('toWayPointID')}")
            print(f"      near: {v.get('nearWayPoints')}, limit: {v.get('limit')}")
