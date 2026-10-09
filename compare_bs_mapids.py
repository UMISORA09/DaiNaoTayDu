# -*- coding: utf-8 -*-
import zlib, pyamf

cfg_path = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\config.dat'
raw = open(cfg_path, 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]
bs_items = list(pyamf.decode(bytes(obj.get('bs'))))[0]

for it in sorted(bs_items, key=lambda x: x.get('number', 0)):
    num = it.get('number')
    if num <= 10 or num >= 36:
        print(f"num={num}: name={it.get('name')}, mapid={it.get('mapid')}, monsterid={it.get('monsterid')}")
