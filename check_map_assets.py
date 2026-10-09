# -*- coding: utf-8 -*-
import os

maps = ['4', '16', '14', '63', '62', '82', '89', '107', '115', '117', '120']

for base in [r'D:\server\GPHWEB\wwwroot\res\tw\r\m', r'D:\server\GPHWEB\wwwroot\res\r\m', r'D:\server\GPHWEB\wwwroot\res\assets\map']:
    if os.path.exists(base):
        print(f"Base: {base}")
        for m in maps:
            p = os.path.join(base, m)
            exists = os.path.exists(p)
            cnt = len(os.listdir(p)) if exists else 0
            print(f"   Map {m}: exists={exists}, files={cnt}")
