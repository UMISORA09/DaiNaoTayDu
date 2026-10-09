# -*- coding: utf-8 -*-
import os

target = b"B100001"
for root_dir in [r"d:\server\server\config", r"d:\server\GPHWEB\wwwroot\res"]:
    for root, dirs, files in os.walk(root_dir):
        for f in files:
            p = os.path.join(root, f)
            try:
                content = open(p, "rb").read()
                if target in content:
                    print(f"Found in {p}")
            except Exception:
                pass
