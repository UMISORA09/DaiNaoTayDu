# -*- coding: utf-8 -*-
import zlib, pyamf

cfg_path = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\config.dat'
raw = open(cfg_path, 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]
val_bs = bytes(obj.get('bs'))
bs_items = list(pyamf.decode(val_bs))[0]

print(f"Total bs_items: {len(bs_items)}")
for x in sorted(bs_items, key=lambda it: it.get('number', 0)):
    print(f"num={x.get('number')}, name={x.get('name')}, lvl={x.get('level')}, mapid={x.get('mapid')}, mapname={x.get('mapname')}, point={x.get('point')}, monsterid={x.get('monsterid')}")
