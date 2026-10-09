# -*- coding: utf-8 -*-
import pyamf

p = r'D:\server\server\config\game\sys_config\BossTiaoZhan.jat'
items = list(pyamf.decode(open(p, 'rb').read()))[0]
for it in items:
    if it.get('number') in [10, 23, 36, 37, 38, 39, 40, 41, 42, 43]:
        print(f"Server Boss {it.get('number')}: needlv={it.get('needlv')}, mapid={it.get('mapid')}, monsterid={it.get('monsterid')}")
