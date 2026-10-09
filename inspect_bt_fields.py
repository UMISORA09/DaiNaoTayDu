# -*- coding: utf-8 -*-
import pyamf

p_dat = r'D:\server\GPHWEB\wwwroot\res\java\zhcn\BossTiaoZhan.dat'
items_dat = list(pyamf.decode(open(p_dat, 'rb').read()))[0]
print(f"BossTiaoZhan.dat item 0 keys: {list(items_dat[0].keys())}")
print(f"BossTiaoZhan.dat item 0: {items_dat[0]}")

p_jat = r'D:\server\GPHWEB\wwwroot\res\java\zhcn\BossTiaoZhan.jat'
items_jat = list(pyamf.decode(open(p_jat, 'rb').read()))[0]
print(f"BossTiaoZhan.jat item 0 keys: {list(items_jat[0].keys())}")
print(f"BossTiaoZhan.jat item 0: {items_jat[0]}")
# Find boss 38, 40, 42 in jat
for it in items_jat:
    if it.get('number') in [38, 39, 40, 41, 42, 43]:
        print(f"Jat boss {it.get('number')}: name={it.get('name')}, mapid={it.get('mapid')}, mapname={it.get('mapname')}, point={it.get('point')}")
