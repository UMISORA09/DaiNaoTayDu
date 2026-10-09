# -*- coding: utf-8 -*-
import os

maps = ['107', '115', '117', '120']
coords = {
    '107': [(108, 16), (93, 95)],
    '115': [(58, 12), (7, 59)],
    '117': [(17, 24), (36, 151)],
    '120': [(101, 8), (109, 138)],
}

for m in maps:
    p = os.path.join(r'D:\server\server\config\game\map_config', m, 'path.mm')
    if os.path.exists(p):
        raw = open(p, 'rb').read()
        print(f"Map {m} path.mm size: {len(raw)}")
        # Check if text or binary
        sample = raw[:50]
        print(f"  sample: {sample}")
