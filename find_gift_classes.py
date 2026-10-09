# -*- coding: utf-8 -*-
import zipfile

with zipfile.ZipFile(r'D:\server\server\dntg_start.jar') as z:
    for name in z.namelist():
        if any(w in name.lower() for w in ['gift', 'duihuan', 'card', 'activation', 'cdk']):
            print("Class in jar:", name)
