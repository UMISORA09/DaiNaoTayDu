# -*- coding: utf-8 -*-
import zlib, pyamf

cfg_path = r'D:\server\GPHWEB\wwwroot\res\config\zhcn\config.dat'
raw = open(cfg_path, 'rb').read()
data = zlib.decompress(raw, -15)
obj = list(pyamf.decode(data))[0]
val_bs = bytes(obj.get('bs'))
bs_items = list(pyamf.decode(val_bs))[0]

for it in bs_items:
    if it.get('number') in [36, 37, 38, 39, 40, 41, 42, 43]:
        print(f"BS {it.get('number')}:")
        for k, v in it.items():
            print(f"   {k}: {v}")

