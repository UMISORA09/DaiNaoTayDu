# -*- coding: utf-8 -*-
import os

target_swfs = [
    r'D:\server\GPHWEB\wwwroot\res\assets\tzBoss.swf',
    r'D:\server\GPHWEB\wwwroot\res\assets\bossUI.swf',
    r'D:\server\GPHWEB\wwwroot\res\assets\zhcn\bossplaces.swf',
    r'D:\server\GPHWEB\wwwroot\tg.swf',
]

for p in target_swfs:
    if os.path.exists(p):
        raw = open(p, 'rb').read()
        print(f"File {p}, size: {len(raw)}")
        for term in [b'BossTiaoZhan', b'bs', b'bossplaces', b'getBoss', b'freshtime', b'monsterid']:
            if term in raw:
                print(f"   found {term}")
