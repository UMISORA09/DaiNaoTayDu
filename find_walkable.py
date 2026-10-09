# -*- coding: utf-8 -*-
import os, struct

def find_nearest_walkable(mid, tx, ty):
    p = os.path.join(r'D:\server\server\config\game\map_config', mid, 'path.mm')
    raw = open(p, 'rb').read()
    w, h = struct.unpack('>II', raw[:8])
    grid = raw[8:]
    best = None
    best_dist = 999999
    for r in range(1, 30):
        for dy in range(-r, r+1):
            for dx in range(-r, r+1):
                x = tx + dx
                y = ty + dy
                if 0 <= x < w and 0 <= y < h:
                    if grid[y * w + x] == 0:
                        dist = dx*dx + dy*dy
                        if dist < best_dist:
                            best_dist = dist
                            best = (x, y)
        if best:
            break
    print(f"Map {mid} original ({tx}, {ty}) -> nearest walkable: {best} (dist={best_dist**0.5:.1f})")
    return best

find_nearest_walkable('107', 108, 16)
find_nearest_walkable('107', 93, 95)

find_nearest_walkable('115', 58, 12)
find_nearest_walkable('115', 7, 59)

find_nearest_walkable('117', 17, 24)
find_nearest_walkable('117', 36, 151)

find_nearest_walkable('120', 101, 8)
find_nearest_walkable('120', 109, 138)
