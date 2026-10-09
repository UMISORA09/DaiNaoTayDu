# -*- coding: utf-8 -*-
import os, struct

maps_data = {
    '107': [(108, 16), (93, 95)],
    '115': [(58, 12), (7, 59)],
    '117': [(17, 24), (36, 151)],
    '120': [(101, 8), (109, 138)],
}

for m, pts in maps_data.items():
    p = os.path.join(r'D:\server\server\config\game\map_config', m, 'path.mm')
    raw = open(p, 'rb').read()
    w, h = struct.unpack('>II', raw[:8])
    grid = raw[8:]
    print(f"Map {m}: w={w}, h={h}, grid_len={len(grid)}")
    for x, y in pts:
        if 0 <= x < w and 0 <= y < h:
            val = grid[y * w + x]
            print(f"  Point ({x}, {y}): value={val} ({'WALKABLE' if val == 0 else 'BLOCKED'})")
        else:
            print(f"  Point ({x}, {y}): OUT OF BOUNDS!")
