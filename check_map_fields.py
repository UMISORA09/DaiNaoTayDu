# -*- coding: utf-8 -*-
import zlib, pyamf

# 1. Check config.dat['bs']
raw = open(r'D:\server\GPHWEB\wwwroot\res\config\zhcn\config.dat', 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]
bs_items = list(pyamf.decode(bytes(obj.get('bs'))))[0]

print("--- config.dat['bs'] ---")
for it in bs_items:
    num = it.get('number')
    if num in [1, 2, 7, 8, 9, 10, 36, 38, 40, 42]:
        print(f"BS {num}: keys={list(it.keys())}")
        print(f"   name={it.get('name')}, mapid={it.get('mapid')}, mapname={it.get('mapname')}, point={it.get('point')}")

# 2. Check BossTiaoZhan.jat
raw_jat = open(r'D:\server\server\config\game\sys_config\BossTiaoZhan.jat', 'rb').read()
jat_items = list(pyamf.decode(raw_jat))[0]
print("\n--- BossTiaoZhan.jat ---")
for it in jat_items:
    num = it.get('number')
    if num in [1, 2, 7, 8, 9, 10, 36, 38, 40, 42]:
        print(f"Jat {num}: keys={list(it.keys())}")
        print(f"   name={it.get('name')}, mapid={it.get('mapid')}, mapname={it.get('mapname')}, point={it.get('point')}")
