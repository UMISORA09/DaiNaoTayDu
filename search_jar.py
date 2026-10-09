# -*- coding: utf-8 -*-
import zipfile

with zipfile.ZipFile(r'D:\server\server\dntg_start.jar') as z:
    for name in z.namelist():
        if name.endswith('.class'):
            content = z.read(name)
            if b'BossTiaoZhan' in content or b'bossTiaoZhan' in content:
                print("Found in class:", name)
