# -*- coding: utf-8 -*-
import zlib, pyamf

cfg_path = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\config.dat'
raw = open(cfg_path, 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]

val_bs = bytes(obj.get('bs'))
bs_items = list(pyamf.decode(val_bs))[0]

monsters = {m.get('id'): m for m in list(pyamf.decode(bytes(obj['1'])))[0]}

print(f"{'Num':<4} | {'BS Name':<25} | {'Monster ID':<10} | {'Monster Name':<25} | {'Lvl':<5} | {'MapID in BS':<15} | {'Monster Map':<10}")
print("-" * 105)
for b in sorted(bs_items, key=lambda x: x.get('number', 0)):
    mid = b.get('monsterid')
    m = monsters.get(mid, {})
    print(f"{b.get('number', 0):<4} | {b.get('name', ''):<25} | {mid:<10} | {m.get('name', 'NOT FOUND'):<25} | {m.get('level', 'N/A'):<5} | {str(b.get('mapid', '')):<15} | {m.get('map', 'N/A')}")
