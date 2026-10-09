# -*- coding: utf-8 -*-
import os, struct

def check_area(m, target_x, target_y):
    p = os.path.join(r'D:\server\server\config\game\map_config', m, 'path.mm')
    raw = open(p, 'rb').read()
    w, h = struct.unpack('>II', raw[:8])
    grid = raw[8:]
    print(f"\nMap {m} around ({target_x}, {target_y}) [w={w}, h={h}]:")
    for dy in range(-4, 5):
        row = []
        for dx in range(-4, 5):
            x = target_x + dx
            y = target_y + dy
            if 0 <= x < w and 0 <= y < h:
                val = grid[y * w + x]
                row.append(str(val))
            else:
                row.append('X')
        print(f"y={target_y+dy:3d}: " + " ".join(row))

check_area('115', 58, 12)
check_area('117', 17, 24)
check_area('120', 101, 8)
