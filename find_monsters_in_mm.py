# -*- coding: utf-8 -*-
import os, re

for mid in ['107', '115', '117', '120']:
    p = os.path.join(r'D:\server\server\config\game\map_config', mid, 'monster.mm')
    raw = open(p, 'rb').read()
    # Find all monster ids like B1000..., B2000..., D15..., etc.
    matches = re.findall(rb'([A-Z][0-9]{6})', raw)
    print(f"Map {mid} monsters in monster.mm:", set(m.decode() for m in matches))
