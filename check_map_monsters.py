# -*- coding: utf-8 -*-
import os

maps = ['107', '115', '117', '120']
for m in maps:
    p = os.path.join(r'D:\server\server\config\game\map_config', m, 'monster.mm')
    if os.path.exists(p):
        print(f"--- Map {m} monster.mm ---")
        lines = open(p, 'r', encoding='utf-8', errors='ignore').readlines()
        for l in lines:
            if any(b in l for b in ['B1000', 'B2000', 'boss', 'Boss']):
                print(" ", l.strip())
